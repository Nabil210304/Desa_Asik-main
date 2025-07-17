// Fungsi utama untuk menampilkan sidebar, ubah warna navbar, dan sembunyikan elemen lain
const showNavbar = (toggleId, navId, bodyId, headerId, loginId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId),
        login = document.getElementById(loginId);

    if (toggle && nav && bodypd && headerpd && login) {
        toggle.addEventListener("click", () => {
            // Tampilkan sidebar
            nav.classList.toggle("show");

            // Ubah ikon toggle menjadi 'X'
            toggle.classList.toggle("bx-x");

            // Tambah padding ke body dan header agar layout tetap rapi
            bodypd.classList.toggle("body-pd");
            headerpd.classList.toggle("body-pd");

            // Sembunyikan tombol login saat sidebar terbuka
            login.classList.toggle("hide-navbar");

            // Ubah warna navbar saat sidebar aktif
            headerpd.classList.toggle("navbar-hidden");
        });
    }
};

// Panggil fungsi dengan id elemen yang sesuai
showNavbar("header-toggle", "nav-bar", "body-pd", "header", "header-login");

// Highlight link aktif di sidebar
const linkColor = document.querySelectorAll(".nav__link");

function colorLink() {
    if (linkColor) {
        linkColor.forEach((l) => l.classList.remove("active"));
        this.classList.add("active");
    }
}

// Tambah event klik ke setiap link agar aktif saat dipilih
linkColor.forEach((l) => l.addEventListener("click", colorLink));
