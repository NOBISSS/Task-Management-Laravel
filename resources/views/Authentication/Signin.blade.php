@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')

<div class="auth-layout">

  {{-- ========== LEFT: Brand Panel ========== --}}
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

    <div class="brand-content">
      <h2 class="brand-tagline">
        Manage tasks,<br />
        <span>achieve more.</span>
      </h2>
      <p class="brand-desc">
        Streamline your workflow, collaborate with your team, and hit every deadline — all in one beautifully organized workspace.
      </p>
    </div>

    <div class="brand-stats">
      <div class="stat-card">
        <div class="stat-number">12k+</div>
        <div class="stat-label">Active Users</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">98%</div>
        <div class="stat-label">On-Time Rate</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">4.9★</div>
        <div class="stat-label">Avg Rating</div>
      </div>
    </div>
  </aside>

  {{-- ========== RIGHT: Sign In Form ========== --}}
  <main class="auth-form-panel">
    <div class="auth-form-wrap">

      <div class="form-header">
        <div class="form-eyebrow">Welcome back</div>
        <h1 class="form-title">Sign in to TaskFlow</h1>
        <p class="form-subtitle">
          Don't have an account?
          <a href="{{ route('signup') }}">Create one free →</a>
        </p>
      </div>

      {{-- Session Status (e.g. password reset link sent) --}}
      @if (session('status'))
        <div class="alert alert-success">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" flex-shrink="0">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          {{ session('status') }}
        </div>
      @endif

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-error">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <div>
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <form method="POST" action="/signin/{{ old('email') ?? 'user' }}" class="auth-form">
        @csrf
        {{-- Email --}}
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <div class="input-wrap">
            <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
              autofocus
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
            <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              class="form-input @error('password') is-invalid @enderror"
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
              autocomplete="current-password"
            />
            <button type="button" class="input-toggle" onclick="tfTogglePassword('password', this)" aria-label="Toggle password visibility">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          @error('password')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>

        {{-- Remember Me + Forgot Password --}}
        <div class="form-row">
          <label class="checkbox-wrap">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
            <span class="checkbox-label-text">Remember me</span>
          </label>
          @if (Route::has('password.request'))
            <a class="text-link" href="{{ route('password.request') }}">Forgot password?</a>
          @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary mt-2">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M15 3h6v6M10 14 21 3M21 15v6H3V3h6"/>
          </svg>
          Sign In
        </button>
      </form>

      <div class="divider">
        <div class="divider-line"></div>
        <span class="divider-text">or continue with</span>
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

</div>

@push('scripts')
<script>
  function tfTogglePassword(id, btn) {
    const input = document.getElementById(id);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
      ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
           <line x1="1" y1="1" x2="23" y2="23"/>
         </svg>`
      : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
           <circle cx="12" cy="12" r="3"/>
         </svg>`;
  }
</script>
@endpush

@endsection