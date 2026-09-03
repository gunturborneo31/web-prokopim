"""
Scraper Berita — Prokopim Kabupaten Mahakam Ulu
https://prokopim.mahakamulukab.go.id/berita/

Mengambil N berita terbaru lengkap dengan:
judul, penulis, tanggal, gambar/foto, narasi (isi berita),
hastag (kategori berita, dipakai sebagai pengganti hashtag),
dan jumlah views.

CARA PAKAI:
1. Install dependency:
   pip install cloudscraper beautifulsoup4 pandas openpyxl
   (lxml TIDAK wajib — script pakai parser bawaan Python "html.parser")

   PENTING: situs ini memakai proteksi anti-bot yang memutus koneksi
   library "requests" biasa (error: Connection aborted / forcibly closed).
   Karena itu script ini pakai "cloudscraper" (bukan requests polos) yang
   meniru fingerprint browser asli agar tidak diblokir.

2. Jalankan:
   python scrape_prokopim_mahulu.py

3. Hasil:
   - prokopim_berita.xlsx  (data lengkap, siap dibuka di Excel)
   - prokopim_berita.csv   (versi CSV)
   - images/               (folder berisi gambar tiap berita, jika DOWNLOAD_IMAGES=True)

Catatan:
- Situs ini tidak memiliki hashtag asli di berita (hashtag hanya dipakai di
  postingan Instagram mereka). Kolom 'hastag' di sini diisi dari kategori
  berita yang tercantum di tiap artikel, diformat seperti hashtag.
- Sopan terhadap server: ada delay antar request & retry otomatis.
"""

import re
import os
import time
import random
import requests
from requests.adapters import HTTPAdapter
from urllib3.util.retry import Retry
from bs4 import BeautifulSoup
import pandas as pd

BASE = "https://prokopim.mahakamulukab.go.id"
LIST_URL = BASE + "/berita/page/{page}/"
TARGET_COUNT = 100          # jumlah berita yang ingin diambil
DOWNLOAD_IMAGES = True      # set False kalau tidak mau download gambar
IMAGES_DIR = "images"
DELAY_RANGE = (0.8, 1.8)    # jeda antar request (detik) agar tidak membebani server

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36"
        " (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
    ),
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "Accept-Language": "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
}

# Parser HTML: pakai "html.parser" bawaan Python (tidak perlu install apa pun).
PARSER = "html.parser"

# Server target ini sering memutus koneksi secara acak (Connection reset /
# forcibly closed), bahkan untuk request yang wajar. Solusinya bukan pakai
# cloudscraper (yang justru lebih sering ditolak di sini), tapi requests.Session
# biasa dengan retry/backoff yang kuat + selalu buka koneksi baru tiap request
# (tanpa keep-alive) supaya tidak kena reset di tengah handshake.
session = requests.Session()
session.headers.update(HEADERS)

retry_strategy = Retry(
    total=6,
    backoff_factor=1.5,
    status_forcelist=[429, 500, 502, 503, 504],
    allowed_methods=["GET"],
)
adapter = HTTPAdapter(max_retries=retry_strategy, pool_connections=1, pool_maxsize=1)
session.mount("https://", adapter)
session.mount("http://", adapter)


def get_soup(url, retries=6):
    """Ambil halaman dengan retry manual di level koneksi (bukan hanya HTTP
    status), karena error di sini biasanya ConnectionResetError saat TLS
    handshake, bukan status code jelek."""
    for attempt in range(retries):
        try:
            # Connection: close supaya tiap percobaan pakai socket baru,
            # menghindari reused-connection yang sudah diputus server.
            resp = session.get(
                url, timeout=30, headers={"Connection": "close"}
            )
            if resp.status_code == 200:
                return BeautifulSoup(resp.text, PARSER)
            else:
                print(f"  [!] Status {resp.status_code} untuk {url}")
        except Exception as e:
            print(f"  [!] Error fetch {url} (percobaan {attempt + 1}/{retries}): {e}")
        time.sleep(2 * (attempt + 1) + random.uniform(0, 1))
    return None


def collect_article_urls(target_count):
    """Kumpulkan link artikel dari halaman listing /berita/page/N/."""
    urls = []
    page = 1
    while len(urls) < target_count:
        list_url = LIST_URL.format(page=page)
        print(f"[listing] Mengambil halaman {page}: {list_url}")
        soup = get_soup(list_url)
        if soup is None:
            break

        # Setiap item berita dibungkus <article class="cz_default_loop ... post ...">
        # di dalam <div class="cz_posts_container">. Ambil link pertama tiap
        # article (link judul), bukan h2/h3 a saja karena tema ini tidak
        # selalu memakai heading untuk judul di listing.
        found_this_page = 0
        for art in soup.select("article.post"):
            a_tag = art.select_one("h2 a, h3 a, .cz_post_title a, a[href]")
            if not a_tag:
                continue
            href = a_tag.get("href")
            if not href:
                continue
            if href.startswith(BASE) and href not in urls:
                # filter supaya bukan link kategori/pagination
                if "/category/" in href or "/page/" in href or "/author/" in href:
                    continue
                urls.append(href)
                found_this_page += 1
            if len(urls) >= target_count:
                break

        if found_this_page == 0:
            print("  Tidak ada artikel baru ditemukan, berhenti.")
            break

        page += 1
        time.sleep(random.uniform(*DELAY_RANGE))

    return urls[:target_count]


def clean_text(text):
    if not text:
        return ""
    return re.sub(r"\s+", " ", text).strip()


def parse_article(url):
    soup = get_soup(url)
    if soup is None:
        return None

    data = {"url": url}

    # --- Judul ---
    h1 = soup.find("h1")
    data["judul"] = clean_text(h1.get_text()) if h1 else ""

    # --- Gambar / foto (og:image) ---
    og_image = soup.find("meta", property="og:image")
    data["gambar"] = og_image["content"].strip() if og_image and og_image.get("content") else ""

    # --- Tanggal (meta article:published_time, fallback cari pola tanggal Indonesia) ---
    pub_time = soup.find("meta", property="article:published_time")
    if pub_time and pub_time.get("content"):
        data["tanggal"] = pub_time["content"][:10]  # YYYY-MM-DD
    else:
        m = re.search(
            r"\d{1,2}\s+(Januari|Februari|Maret|April|Mei|Juni|Juli|Agustus|"
            r"September|Oktober|November|Desember)\s+\d{4}",
            soup.get_text(),
        )
        data["tanggal"] = m.group(0) if m else ""

    # --- Penulis (link ke /author/...) ---
    author_link = soup.select_one('a[href*="/author/"]')
    data["penulis"] = clean_text(author_link.get_text()) if author_link else ""

    # --- Jumlah views ("Viewers: N") ---
    m_views = re.search(r"Viewers:\s*([\d.,]+)", soup.get_text())
    data["views"] = m_views.group(1).replace(".", "").replace(",", "") if m_views else ""

    # --- Narasi (isi berita) ---
    # Ambil paragraf utama: biasanya berada di area konten setelah H1 dan sebelum
    # bagian "Berita Terkait" / kotak share sosial media.
    content_paragraphs = []
    # Cari kontainer utama artikel (heuristik umum WordPress)
    content_area = soup.find("article") or soup.find("div", class_=re.compile("content|entry|post", re.I))
    if content_area:
        for p in content_area.find_all(["p", "blockquote"]):
            txt = clean_text(p.get_text())
            if txt and "Viewers:" not in txt:
                content_paragraphs.append(txt)
    if not content_paragraphs:
        # fallback: ambil semua <p> di halaman lalu buang navigasi/menu
        for p in soup.find_all("p"):
            txt = clean_text(p.get_text())
            if txt and len(txt) > 40:
                content_paragraphs.append(txt)

    data["narasi"] = "\n\n".join(content_paragraphs)

    # --- Hastag (kategori berita, dipakai sebagai pengganti hashtag) ---
    # Kategori biasanya muncul sebagai deretan link /category/xxx/ di bawah konten
    categories = []
    for a in soup.select('a[href*="/category/"]'):
        cat = clean_text(a.get_text())
        if cat and cat not in categories:
            categories.append(cat)
    data["hastag"] = " ".join(f"#{c.replace(' ', '')}" for c in categories)

    return data


def download_image(img_url, filename_base):
    if not img_url:
        return ""
    os.makedirs(IMAGES_DIR, exist_ok=True)
    ext = os.path.splitext(img_url.split("?")[0])[1]
    if ext.lower() not in (".jpg", ".jpeg", ".png", ".webp", ".gif"):
        ext = ".jpg"
    filepath = os.path.join(IMAGES_DIR, f"{filename_base}{ext}")
    try:
        r = session.get(img_url, timeout=20)
        if r.status_code == 200:
            with open(filepath, "wb") as f:
                f.write(r.content)
            return filepath
    except Exception as e:
        print(f"  [!] Gagal download gambar {img_url}: {e}")
    return ""


def main():
    print(f"=== Mengumpulkan {TARGET_COUNT} link berita dari {BASE}/berita/ ===")
    article_urls = collect_article_urls(TARGET_COUNT)
    print(f"Ditemukan {len(article_urls)} link artikel.\n")

    results = []
    for i, url in enumerate(article_urls, start=1):
        print(f"[{i}/{len(article_urls)}] Scraping: {url}")
        article = parse_article(url)
        if article:
            if DOWNLOAD_IMAGES and article.get("gambar"):
                slug = url.rstrip("/").split("/")[-1][:60]
                local_path = download_image(article["gambar"], f"{i:03d}_{slug}")
                article["gambar_lokal"] = local_path
            else:
                article["gambar_lokal"] = ""
            results.append(article)
        time.sleep(random.uniform(*DELAY_RANGE))

    # Susun ulang kolom sesuai urutan yang diminta
    df = pd.DataFrame(results)
    kolom = ["judul", "gambar", "gambar_lokal", "penulis", "tanggal",
             "narasi", "hastag", "views", "url"]
    kolom = [k for k in kolom if k in df.columns]
    df = df[kolom]

    df.to_excel("prokopim_berita.xlsx", index=False)
    df.to_csv("prokopim_berita.csv", index=False, encoding="utf-8-sig")

    print(f"\nSelesai. {len(df)} berita disimpan ke:")
    print("  - prokopim_berita.xlsx")
    print("  - prokopim_berita.csv")
    if DOWNLOAD_IMAGES:
        print(f"  - folder '{IMAGES_DIR}/' untuk gambar")


if __name__ == "__main__":
    main()