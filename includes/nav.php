<nav>
  <div class="flex justify-between items-center px-10 pt-4">

    <div class="hidden lg:flex items-center h-20 w-20">
      <a href="index.php">
        <img class="w-full" src="imagem/The Recipe - logo.png" alt="Logo The Recipe">
      </a>
    </div>
  
    <div class="hidden md:flex items-center space-x-6">
      <a href="index.php" class="p-4 font-sans text-lg font-bold hover:text-[#5A5957]">Home</a>
      <a href="receitas.php" class="p-4 font-sans text-lg font-bold hover:text-[#5A5957]">Receitas</a>
      <a href="sobre.php" class="p-4 font-sans text-lg font-bold hover:text-[#5A5957]">Sobre Nós</a>
      <a href="favoritos.php" class="p-4 font-sans text-lg font-bold hover:text-[#5A5957]">Favoritos</a>

      <?php if (isset($_SESSION['ligado']) && $_SESSION['ligado'] == true): ?>
      <div class="relative group"> 
        <a href="#" class="flex items-center focus:outline-none" tabindex="0"> 
            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white font-semibold text-lg ring-2 ring-offset-2 ring-indigo-400 transition-all duration-150">
                <?= $_SESSION['iniciais'] ?>
            </span>
        </a>
        
        <div id="user-menu" class="absolute right-0 top-full pt-1 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block group-focus-within:block border border-gray-100">
          <div class="px-4 py-2 text-sm text-gray-700 border-b font-medium">
              Olá, <?= $_SESSION['nome'] ?>!
          </div>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
            Dashboard
          </a>
          <a href="auth/logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
            Logout
          </a>
        </div>
      </div>
      <?php else: ?>
        <a href="login.php" class="p-4 font-sans text-lg font-bold hover:text-[#5A5957]">
            Login
        </a>
      <?php endif; ?>
    </div>

    <button
      id="hamburger-btn"
      class="md:hidden flex flex-col justify-between w-8 h-6 focus:outline-none"
      aria-label="Abrir menu"
    >
      <span class="block h-1 bg-gray-800 rounded transition-transform"></span>
      <span class="block h-1 bg-gray-800 rounded transition-opacity"></span>
      <span class="block h-1 bg-gray-800 rounded transition-transform"></span>
    </button>
  </div>

  <div id="mobile-menu" class="md:hidden hidden px-10 pb-4 space-y-2">
    <a href="index.php" class="block font-sans text-lg font-bold hover:text-[#5A5957]">Home</a>
    <a href="receitas.php" class="block font-sans text-lg font-bold hover:text-[#5A5957]">Receitas</a>
    <a href="sobre.php" class="block font-sans text-lg font-bold hover:text-[#5A5957]">Sobre Nós</a>
    <a href="favoritos.php" class="block font-sans text-lg font-bold hover:text-[#5A5957]">Favoritos</a>

    <?php if (isset($_SESSION['ligado']) && $_SESSION['ligado'] == true): ?>
    <div class="relative group"> 
      <a href="#" class="flex items-center focus:outline-none" tabindex="0"> 
          <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white font-semibold text-lg ring-2 ring-offset-2 ring-indigo-400 transition-all duration-150">
              <?= $_SESSION['iniciais'] ?>
          </span>
      </a>
      
      <div id="user-menu" class="absolute right-0 top-full pt-1 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block group-focus-within:block border border-gray-100">
        <div class="px-4 py-2 text-sm text-gray-700 border-b font-medium">
            Olá, <?= $_SESSION['nome'] ?>!
        </div>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
          Dashboard
        </a>
        <a href="auth/logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
          Logout
        </a>
      </div>
    </div>
    <?php else: ?>
      <a href="login.php" class="block font-sans text-lg font-bold hover:text-[#5A5957]">
          Login
      </a>
    <?php endif; ?>



  </div>

  <div>
    <hr class="border-black mx-10 my-2">
  </div>
</nav>

<script>
const btn = document.getElementById('hamburger-btn');
const menu = document.getElementById('mobile-menu');

btn.addEventListener('click', () => {
  menu.classList.toggle('hidden');

  const lines = btn.querySelectorAll('span');
  lines[0].classList.toggle('translate-y-2');
  lines[0].classList.toggle('rotate-45');
  lines[2].classList.toggle('-translate-y-2');
  lines[2].classList.toggle('-rotate-45');
  lines[1].classList.toggle('opacity-0');
});
</script>
