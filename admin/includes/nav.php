<aside id="sidebar" class="w-64 bg-[#D1C8C1] text-black flex-shrink-0 fixed inset-y-0 left-0 -translate-x-full
            md:relative md:translate-x-0 transition duration-300 ease-in-out flex flex-col z-50 shadow-2xl">

    <div class="p-4 text-2xl font-extrabold">
        <a href="dashboard.php">Gestão</a>
    </div>

    <nav class="flex-grow p-4 space-y-2">
        <a href="receitas.php"
           class="flex items-center p-3 rounded-lg bg-white/40 font-semibold">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="font-bold">Gestão de Receitas</span>
        </a>

        <a href="utilizadores.php"
           class="flex items-center p-3 rounded-lg bg-white/40 transition font-semibold">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a2 2 0 01-2-2v-1a2 2 0 012-2h6a2 2 0 012 2v1a2 2 0 01-2 2z"/>
            </svg>
            Gestão de Utilizadores
        </a>
    </nav>

    <div class="p-4">
    <a href="/DEPWEB/admin/includes/logout.php"
       class="flex items-center justify-center p-3 rounded-lg bg-[#9A0526] text-white font-semibold text-lg">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Logout
    </a>
</div>

</aside>
