<nav class="px-4 sm:px-10 pt-4">
  <div class="flex items-center justify-between gap-4">
    
    <a href="index.php" class="w-16 sm:w-20">
      <img src="imagem/The Recipe - logo.png" alt="The Recipe">
    </a>

    <div class="hidden md:flex items-center gap-6 font-bold">

      <form action="receitas.php" method="GET" class="hidden md:block relative w-48 lg:w-64">
        <input type="text" name="busca" placeholder="Procure..." required class="w-full text-sm border border-black rounded-md pl-3 pr-20 py-2">
        <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-3 py-1 text-sm rounded hover:bg-[#B09B80] hover:text-white">
          Procurar
        </button>
      </form>

      <a href="index.php" class="hover:text-[#5A5957]">Home</a>
      <a href="receitas.php" class="hover:text-[#5A5957]">Receitas</a>
      <a href="sobre.php" class="hover:text-[#5A5957]">Sobre Nós</a>
      
      <?php if (!empty($_SESSION['ligado'])): ?>
        <a href="favoritos.php" class="hover:text-[#5A5957]">Favoritos</a>
        
        <div class="relative">
          <span id="avatar-btn" class="cursor-pointer flex items-center justify-center h-10 w-10 rounded-full bg-[#B09B80] text-white text-sm">
            <?= $_SESSION['iniciais'] ?>
          </span>
          <div id="avatar-menu" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden">
            <div class="px-4 py-2 border-b">Olá, <?= $_SESSION['nome'] ?></div>
            <a href="admin/dashboard.php" class="block px-4 py-2 hover:bg-gray-50">Dashboard</a>
            <a href="auth/logout.php" class="block px-4 py-2 text-red-600 hover:bg-red-50">Logout</a>
          </div>
        </div>
      <?php else: ?>
        <a href="login.php" class="hover:text-[#5A5957]">Login</a>
      <?php endif; ?>
    </div>

    <form action="receitas.php" method="GET" class="relative md:hidden">
      <input type="text" name="busca" placeholder="Procure..." required class="w-full text-sm border border-black rounded-md pl-3 pr-24 py-1">
      <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-sm px-3 py-1 rounded hover:bg-[#B09B80] hover:text-white">
        Procurar
      </button>
    </form>

    <button id="menu-btn" class="md:hidden">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-3 pb-4">
    <div class="space-y-2 font-bold pt-2">
      <a href="index.php" class="block hover:text-[#5A5957]">Home</a>
      <a href="receitas.php" class="block hover:text-[#5A5957]">Receitas</a>
      <a href="sobre.php" class="block hover:text-[#5A5957]">Sobre Nós</a>
      <?php if (!empty($_SESSION['ligado'])): ?>
        <a href="favoritos.php" class="block hover:text-[#5A5957]">Favoritos</a>
        <a href="admin/dashboard.php" class="block hover:text-[#5A5957]">Dashboard</a>
        <a href="auth/logout.php" class="block text-red-600">Logout</a>
      <?php else: ?>
        <a href="login.php" class="block hover:text-[#5A5957]">Login</a>
      <?php endif; ?>
    </div>
  </div>

  <hr class="border-black my-2">
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
