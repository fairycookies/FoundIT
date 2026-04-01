<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  @vite(['resources/css/app.css', 'resources/css/signin.css', 'resources/js/app.js'])
</head>
<body>
  <div class="split">

    <!-- Left – illustration -->
    <div class="panel-left">
    <img
      src="{{ asset('images/Gambardepan.png') }}"
      alt="Illustration"
      class="illustration"
      onerror="this.src='...'; this.style.width='180px';"
    />
    </div>

    <!-- Right – form -->
    <div class="panel-right">
      <h1 class="form-title">Welcome Back !</h1>

      <div class="field-group">

        <!-- Username -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
          </span>
          <input type="text" id="signin-username" placeholder="Username" autocomplete="username"/>
        </div>

        <!-- Password -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24"><path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/></svg>
          </span>
          <input type="password" id="signin-password" placeholder="Password" autocomplete="current-password"/>
        </div>

      </div>

      <div class="btn-row">
        <button class="btn-primary" onclick="handleSignIn()">Sign in</button>
        <button class="btn-outline" onclick="window.location.href='/signup'">Create an account</button>
      </div>

      <p id="signin-error" class="error-msg"></p>
    </div>

  </div>

  <!-- Toast -->
  <div id="toast" class="toast"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showToast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 3000);
    }

    function handleSignIn() {
      const username = document.getElementById('signin-username').value.trim();
      const password = document.getElementById('signin-password').value;
      const errEl    = document.getElementById('signin-error');

      if (!username || !password) {
        errEl.textContent = 'Username dan password wajib diisi.';
        errEl.style.display = 'block';
        return;
      }

      // Ambil data akun dari localStorage
      const users = JSON.parse(localStorage.getItem('users') || '[]');
      const user  = users.find(u => u.username === username && u.password === password);

      if (!user) {
        errEl.textContent = 'Username atau password salah.';
        errEl.style.display = 'block';
        return;
      }

      errEl.style.display = 'none';
      localStorage.setItem('loggedInUser', JSON.stringify(user));
      showToast('Berhasil masuk!');
      setTimeout(() => window.location.href = '/beranda', 800);
    }

    document.addEventListener('keydown', e => {
      if (e.key === 'Enter') handleSignIn();
    });
  </script>

</body>
</html>