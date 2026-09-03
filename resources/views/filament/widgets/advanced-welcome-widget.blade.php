<div style="display: flex; flex-direction: column; gap: 1.5rem;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <!-- Main Welcome Banner -->
        <div style="grid-column: span 2; position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #2563eb, #1e3a8a); padding: 2rem; color: white; border: 1px solid rgba(255,255,255,0.1);">
            <div style="position: relative; z-index: 10; display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                <div>
                    <h2 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">{{ __('Selamat Datang kembali, :name!', ['name' => $user->name]) }}! 🎉</h2>
                    <p style="margin-top: 0.5rem; color: #dbeafe; font-size: 1.125rem;">
                        {{ __('Anda login sebagai') }} <span style="font-weight: 600; padding: 0.125rem 0.5rem; border-radius: 9999px; background: rgba(255,255,255,0.2);">{{ $userStats['role'] }}</span>.
                        {{ __('Berikut adalah ringkasan performa Anda hari ini.') }}
                    </p>
                </div>
                
                <div style="margin-top: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 0.75rem; padding: 1rem;">
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: #93c5fd;">{{ __('Kontribusi') }}</p>
                        <p style="font-size: 1.5rem; font-weight: 700; margin-top: 0.25rem;">{{ $userStats['posts'] }} <span style="font-size: 0.875rem; font-weight: 400; color: #bfdbfe;">{{ __('Post') }}</span></p>
                    </div>
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 0.75rem; padding: 1rem;">
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: #93c5fd;">{{ __('Total Jangkauan') }}</p>
                        <p style="font-size: 1.5rem; font-weight: 700; margin-top: 0.25rem;">{{ number_format($userStats['views']) }} <span style="font-size: 0.875rem; font-weight: 400; color: #bfdbfe;">{{ __('Baca') }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Decorative blobs -->
            <div style="position: absolute; right: -3rem; top: -3rem; height: 16rem; width: 16rem; border-radius: 9999px; background: rgba(255,255,255,0.05); filter: blur(40px);"></div>
            <div style="position: absolute; left: -2rem; bottom: -2rem; height: 10rem; width: 10rem; border-radius: 9999px; background: rgba(168,85,247,0.1); filter: blur(30px);"></div>
        </div>

        <!-- Top Contributors Card -->
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827;">{{ __('Kontributor Utama') }}</h3>
                <div style="padding: 0.5rem; background: #eff6ff; border-radius: 0.5rem; color: #2563eb;">
                    <x-heroicon-m-trophy style="width: 1.25rem; height: 1.25rem;"/>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($topAuthors as $author)
                    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; border-radius: 0.75rem; transition: background 0.2s;">
                        <div style="position: relative;">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: linear-gradient(to top right, #dbeafe, #e0e7ff); display: flex; align-items: center; justify-content: center; color: #4f46e5; font-weight: 700; font-size: 0.875rem;">
                                {{ substr($author->name, 0, 1) }}
                            </div>
                            @if($loop->first)
                                <div style="position: absolute; top: -0.25rem; right: -0.25rem; width: 1rem; height: 1rem; background: #facc15; border: 2px solid white; border-radius: 9999px; display: flex; align-items: center; justify-content: center;">
                                    <span style="font-size: 10px; color: white; font-weight: 700;">1</span>
                                </div>
                            @endif
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <p style="font-size: 0.875rem; font-weight: 600; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $author->name }}</p>
                            <p style="font-size: 0.75rem; color: #6b7280;">{{ $author->role?->label() ?? __('Anggota') }}</p>
                        </div>
                        <div style="text-align: right;">
                            <p style="font-size: 0.875rem; font-weight: 700; color: #4f46e5;">{{ $author->posts_count }}</p>
                            <p style="font-size: 10px; color: #9ca3af; text-transform: uppercase;">{{ __('Artikel') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
