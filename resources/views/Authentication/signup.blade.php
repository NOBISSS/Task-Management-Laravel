@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')

<div class="auth-layout auth-layout--flipped">

  {{-- ========== LEFT: Sign Up Form ========== --}}
  <main class="auth-form-panel">
    <div class="auth-form-wrap">

      <div class="form-header">
        <div class="form-eyebrow">Get started free</div>
        <h1 class="form-title">Create your account</h1>
        <p class="form-subtitle">
          Already have an account?
          <a href="{{ route('signin') }}">Sign in instead →</a>
        </p>
      </div>

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-error">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <div>
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('signup') }}">
        @csrf

        {{-- First & Last Name --}}
        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label" for="first_name">First Name</label>
            <div class="input-wrap">
              <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              <input
                class="form-input @error('first_name') is-invalid @enderror"
                type="text"
                id="first_name"
                name="first_name"
                value="{{ old('first_name') }}"
                placeholder="John"
                required
                autofocus
              />
            </div>
            @error('first_name')
              <div class="field-error">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="last_name">Last Name</label>
            <div class="input-wrap">
              <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              <input
                class="form-input @error('last_name') is-invalid @enderror"
                type="text"
                id="last_name"
                name="last_name"
                value="{{ old('last_name') }}"
                placeholder="Doe"
                required
              />
            </div>
            @error('last_name')
              <div class="field-error">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- Email --}}
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <div class="input-wrap">
            <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <path d="m2 7 10 7 10-7"/>
            </svg>
            <input
              class="form-input @error('email') is-invalid @enderror"
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="you@example.com"
              required
              autocomplete="email"
            />
          </div>
          @error('email')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <div class="input-wrap">
            <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              class="form-input @error('password') is-invalid @enderror"
              type="password"
              id="password"
              name="password"
              placeholder="Create a strong password"
              required
              autocomplete="new-password"
              oninput="tfStrength(this.value)"
            />
            <button type="button" class="input-toggle" onclick="tfTogglePassword('password', this)" aria-label="Toggle password">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          @error('password')
            <div class="field-error">{{ $message }}</div>
          @enderror

          {{-- Strength Meter --}}
          <div class="strength-meter" id="tf-strength-meter">
            <div class="strength-bars">
              <div class="strength-bar" id="tf-bar-1"></div>
              <div class="strength-bar" id="tf-bar-2"></div>
              <div class="strength-bar" id="tf-bar-3"></div>
              <div class="strength-bar" id="tf-bar-4"></div>
            </div>
            <span class="strength-label" id="tf-strength-label">Weak</span>
          </div>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
          <label class="form-label" for="password_confirmation">Confirm Password</label>
          <div class="input-wrap">
            <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              class="form-input"
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              placeholder="Repeat your password"
              required
              autocomplete="new-password"
            />
            <button type="button" class="input-toggle" onclick="tfTogglePassword('password_confirmation', this)" aria-label="Toggle confirm password">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        {{-- Terms --}}
        <div class="terms-row">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms" class="terms-text">
            I agree to the <a href="{{ url('/terms') }}">Terms of Service</a> and
            <a href="{{ url('/privacy') }}">Privacy Policy</a>.
            I understand my data will be used to provide the TaskFlow service.
          </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <line x1="19" y1="8" x2="19" y2="14"/>
            <line x1="22" y1="11" x2="16" y2="11"/>
          </svg>
          Create Account
        </button>
      </form>

      <div class="divider">
        <div class="divider-line"></div>
        <span class="divider-text">or sign up with</span>
        <div class="divider-line"></div>
      </div>

      <div class="social-row">
        <a href="{{ url('/auth/google') }}" class="btn-social">
          <svg width="16" height="16" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Google
        </a>
        <a href="{{ url('/auth/github') }}" class="btn-social">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
          </svg>
          GitHub
        </a>
      </div>

    </div>
  </main>

  {{-- ========== RIGHT: Brand Panel ========== --}}
  <aside class="auth-brand">
    <a href="{{ url('/') }}" class="brand-logo">
      <div class="brand-icon">
        <svg width="24" height="24" viewBox="0 0 22 22" fill="none">
          <rect x="2" y="2" width="8" height="8" rx="2" fill="#0f2044"/>
          <rect x="12" y="2" width="8" height="8" rx="2" fill="#0f2044" opacity="0.5"/>
          <rect x="2" y="12" width="8" height="8" rx="2" fill="#0f2044" opacity="0.5"/>
          <rect x="12" y="12" width="8" height="8" rx="2" fill="#0f2044"/>
        </svg>
      </div>
      <span class="brand-name">TaskFlow</span>
    </a>

    <div class="brand-features">
      <h2 class="brand-feature-heading">
        Everything you need to <span>stay organized.</span>
      </h2>
      <ul class="feature-list">
        <li class="feature-item">
          <div class="feature-icon-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
          </div>
          <div>
            <div class="feature-text-title">Visual Task Boards</div>
            <div class="feature-text-desc">Drag-and-drop Kanban boards to visualize your workflow at a glance.</div>
          </div>
        </li>
        <li class="feature-item">
          <div class="feature-icon-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <div>
            <div class="feature-text-title">Team Collaboration</div>
            <div class="feature-text-desc">Assign tasks, leave comments, and stay aligned with your entire team.</div>
          </div>
        </li>
        <li class="feature-item">
          <div class="feature-icon-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
          </div>
          <div>
            <div class="feature-text-title">Progress Analytics</div>
            <div class="feature-text-desc">Track completion rates and team performance with real-time reports.</div>
          </div>
        </li>
        <li class="feature-item">
          <div class="feature-icon-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
          </div>
          <div>
            <div class="feature-text-title">Smart Reminders</div>
            <div class="feature-text-desc">Never miss a deadline with automated alerts and priority notifications.</div>
          </div>
        </li>
      </ul>
    </div>

    <div class="brand-testimonial">
      <div class="star-row">
        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
      </div>
      <p class="testimonial-quote">
        "TaskFlow transformed how our team works. We shipped 40% faster after switching — everything is clear, organized, and actually enjoyable to use."
      </p>
      <div class="testimonial-author">
        <div class="author-avatar">SR</div>
        <div>
          <div class="author-name">Sarah Rahman</div>
          <div class="author-role">Product Lead · Nexvia Technologies</div>
        </div>
      </div>
    </div>
  </aside>

</div>

@push('scripts')
<script>
  function tfTogglePassword(id, btn) {
    const input = document.getElementById(id);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
      ? `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
           <line x1="1" y1="1" x2="23" y2="23"/>
         </svg>`
      : `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
           <circle cx="12" cy="12" r="3"/>
         </svg>`;
  }

  function tfStrength(val) {
    const meter = document.getElementById('tf-strength-meter');
    const bars  = [1,2,3,4].map(i => document.getElementById('tf-bar-' + i));
    const label = document.getElementById('tf-strength-label');
    if (!val) { meter.classList.remove('visible'); return; }
    meter.classList.add('visible');

    let score = 0;
    if (val.length >= 8)          score++;
    if (/[A-Z]/.test(val))        score++;
    if (/[0-9]/.test(val))        score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const cls    = ['s-weak','s-fair','s-good','s-strong'];
    const labels = ['Weak','Fair','Good','Strong'];

    bars.forEach((b, i) => {
      b.className = 'strength-bar';
      if (i < score) b.classList.add(cls[score - 1]);
    });
    label.textContent = labels[score - 1] || 'Weak';
  }
</script>
@endpush

@endsection