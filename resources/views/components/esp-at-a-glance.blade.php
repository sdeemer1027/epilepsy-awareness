{{-- ==========================================================
    FUTURE VERSION 

    Convert the ESP at a Glance cards to a dynamic loop.

    Example:

    @foreach($stats as $key => $stat)

        Card Layout

    @endforeach

    This allows new statistics to be added from the controller
    without modifying the Blade component.

========================================================== --}}

<section class="esp-section esp-glance-section">

    <div class="esp-page">

        <div class="esp-section-title">

            <h2>ESP at a Glance</h2>

            <p>

                Every connection, article, discussion, and event helps
                strengthen our growing epilepsy community.

            </p>

        </div>

        <div class="esp-glance-grid">

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">👥</div>

                <div class="esp-stat-number">
                    {{ $stats['members'] }}
                    
                </div>

                <div class="esp-stat-label">
                    Members
                </div>

            </a>

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">📚</div>

                <div class="esp-stat-number">
                   {{ $stats['articles'] }} 
                </div>

                <div class="esp-stat-label">
                    Knowledge Articles
                </div>

            </a>

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">❓</div>

                <div class="esp-stat-number">
                   {{ $stats['questions'] }} 
                </div>

                <div class="esp-stat-label">
                    Questions
                </div>

            </a>

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">💬</div>

                <div class="esp-stat-number">
                     {{ $stats['discussions'] }} 
                </div>

                <div class="esp-stat-label">
                    Discussions
                </div>

            </a>

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">❤️</div>

                <div class="esp-stat-number">
                    {{ $stats['supportGroups'] }}
                </div>

                <div class="esp-stat-label">
                    Support Groups
                </div>

            </a>

            <a href="#" class="esp-stat-card">

                <div class="esp-stat-icon">📅</div>

                <div class="esp-stat-number">
                    {{ $stats['events'] }} 
                </div>

                <div class="esp-stat-label">
                    Events
                </div>

            </a>

        </div>

    </div>

</section>