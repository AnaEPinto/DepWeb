<nav class="px-10 pt-4">
  <div class="flex items-center justify-between">

    <a href="index.php" class="hidden lg:block w-20">
      <img src="imagem/The Recipe - logo.png" alt="The Recipe">
    </a>

    <div class="hidden md:flex items-center gap-6 font-sans text-lg font-bold">
      <a href="index.php" class="hover:text-[#5A5957] transition">Home</a>
      <a href="receitas.php" class="hover:text-[#5A5957] transition">Receitas</a>
      <a href="sobre.php" class="hover:text-[#5A5957] transition">Sobre Nós</a>

    <?php if (!empty($_SESSION['ligado'])): ?>
      <a href="favoritos.php" class="hover:text-[#5A5957] transition">Favoritos</a>

      <div class="relative">
        <span id="avatar-btn" class="cursor-pointer inline-flex items-center justify-center h-10 w-10 rounded-full bg-[#B09B80] text-white text-sm font-semibold shadow-sm hover:bg-[#D1C8C1] transition">
          <?= $_SESSION['iniciais'] ?>
        </span>

        <div id="avatar-menu"class="absolute right-0 mt-2 w-52 bg-white border border-gray-200 rounded-xl text-sm hidden">
          <div class="px-4 py-2 text-sm border-b border-gray-300">
            Olá, <span class=""><?= $_SESSION['nome'] ?></span>
          </div>

          <a href="admin/dashboard.php" class="block px-4 py-2">
            Dashboard
          </a>

          <a href="auth/logout.php" class="block px-4 py-2 text-[#9A0526]">
            Logout
          </a>
        </div>
      </div>

      <?php else: ?>
        <a href="login.php" class="hover:text-[#5A5957] transition">Login</a>
      <?php endif; ?>
    </div>

    <button id="menu-btn" class="md:hidden text-2xl">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </button>
  </div>

  <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-2 font-sans text-lg font-bold">
    <a href="index.php" class="block hover:text-[#5A5957] transition">Home</a>
    <a href="receitas.php" class="block hover:text-[#5A5957] transition">Receitas</a>
    <a href="sobre.php" class="block hover:text-[#5A5957] transition">Sobre Nós</a>

    <?php if (!empty($_SESSION['ligado'])): ?>
      <a href="favoritos.php" class="block hover:text-[#5A5957] transition">Favoritos</a>
      <a href="admin/dashboard.php" class="block hover:text-[#5A5957] transition">Dashboard</a>
      <a href="auth/logout.php" class="block text-red-600 hover:text-red-800 transition">Logout</a>
    <?php else: ?>
      <a href="login.php" class="block hover:text-[#5A5957] transition">Login</a>
    <?php endif; ?>
  </div>

  <hr class="border-black mx-0 my-2">
</nav>

<script>
  // Mobile menu toggle
  document.getElementById('menu-btn').onclick = () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  };

  // Avatar dropdown toggle
  const avatarBtn = document.getElementById('avatar-btn');
  const avatarMenu = document.getElementById('avatar-menu');

  if(avatarBtn) {
    avatarBtn.addEventListener('click', () => {
      avatarMenu.classList.toggle('hidden');
    });

    // Fechar ao clicar fora
    document.addEventListener('click', (e) => {
      if (!avatarBtn.contains(e.target) && !avatarMenu.contains(e.target)) {
        avatarMenu.classList.add('hidden');
      }
    });
  }
</script>
