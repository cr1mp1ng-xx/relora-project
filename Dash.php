<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COD Market - Marketplace Lokal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            light: '#E2FBCE',
                            dark: '#076653',
                            deep: '#0C342C',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles & Gradient 2 implementation */
        .bg-gradient-brand {
            background: linear-gradient(135deg, #E2FBCE 0%, #076653 100%);
        }
        .text-gradient-brand {
            background: linear-gradient(135deg, #076653 0%, #0C342C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #E2FBCE 0%, #076653 100%);
            color: #0C342C;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-gradient:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }
        /* Custom scrollbar for mobile feel */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #076653;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen text-slate-800 flex justify-center items-start sm:py-6">

    <!-- App Container (Mobile Frame on Desktop, Fullscreen on Mobile) -->
    <div id="app" class="w-full max-w-md bg-gray-50 min-h-screen sm:min-h-[844px] sm:max-h-[850px] sm:rounded-[36px] shadow-2xl flex flex-col relative overflow-hidden border-0 sm:border-[8px] border-slate-800">

        <!-- Top App Header -->
        <header class="bg-white px-5 pt-5 pb-3 border-b border-gray-100 sticky top-0 z-20">
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-9 h-9 rounded-full bg-gradient-brand flex items-center justify-center text-slate-900 font-bold text-sm shadow-sm">
                        <i class="fa-solid me-0.5 fa-bag-shopping text-brand-deep"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold tracking-wider text-gray-400">Lokasi Anda</p>
                        <p class="text-xs font-semibold text-slate-800 flex items-center">
                            <i class="fa-solid fa-location-dot text-brand-dark mr-1 text-[11px]"></i> Malang, Jatim
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-[10px] bg-emerald-100 text-brand-dark px-2 py-1 rounded-full font-bold uppercase tracking-wider flex items-center">
                        <i class="fa-solid fa-handshake mr-1"></i> COD Only
                    </span>
                </div>
            </div>

            <!-- Search Bar & Filter Toggle Button -->
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" id="searchInput" placeholder="Cari barang bekas/baru di sekitar..." onkeyup="filterProducts()"
                        class="w-full bg-gray-100 text-xs text-gray-800 pl-9 pr-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-dark/30 transition">
                </div>
                <button onclick="toggleFilterModal()" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center text-slate-700 transition">
                    <i class="fa-solid fa-sliders text-sm"></i>
                </button>
            </div>
        </header>

        <!-- Main Content Area -->
        <main id="mainContent" class="flex-1 overflow-y-auto pb-20 p-4">
            <!-- Content will be injected dynamically by JavaScript -->
        </main>

        <!-- Bottom Navigation Bar -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 px-6 py-2 flex justify-between items-center z-30">
            <button onclick="switchTab('home')" id="nav-home" class="flex flex-col items-center gap-1 text-brand-dark font-medium transition">
                <i class="fa-solid fa-house text-lg"></i>
                <span class="text-[10px]">Beranda</span>
            </button>
            <button onclick="switchTab('wishlist')" id="nav-wishlist" class="flex flex-col items-center gap-1 text-gray-400 hover:text-brand-dark font-medium transition relative">
                <i class="fa-solid fa-heart text-lg"></i>
                <span class="text-[10px]">Wishlist</span>
                <span id="wishlistBadge" class="hidden absolute -top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <button onclick="switchTab('chat')" id="nav-chat" class="flex flex-col items-center gap-1 text-gray-400 hover:text-brand-dark font-medium transition">
                <i class="fa-solid fa-comments text-lg"></i>
                <span class="text-[10px]">Chat</span>
            </button>
            <button onclick="switchTab('sell')" id="nav-sell" class="flex flex-col items-center gap-1 text-gray-400 hover:text-brand-dark font-medium transition">
                <i class="fa-solid fa-circle-plus text-lg"></i>
                <span class="text-[10px]">Jual</span>
            </button>
        </nav>

        <!-- Filter Modal -->
        <div id="filterModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden flex items-end sm:items-center justify-center p-0 sm:p-4">
            <div class="bg-white w-full max-w-md rounded-t-3xl sm:rounded-3xl p-6 shadow-xl animate-in slide-in-from-bottom duration-300">
                <div class="flex justify-between items-center mb-4 border-b pb-3">
                    <h3 class="font-bold text-slate-800 text-base">Filter Jelajah Barang</h3>
                    <button onclick="toggleFilterModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Jarak Filter Slider -->
                <div class="mb-5">
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-xs font-semibold text-slate-700">Maksimal Jarak (COD)</label>
                        <span id="distanceValue" class="text-xs font-bold text-brand-dark">15 km</span>
                    </div>
                    <input type="range" id="distanceRange" min="1" max="50" value="15" oninput="updateDistanceLabel(this.value)"
                        class="w-full accent-emerald-700 cursor-pointer">
                    <div class="flex justify-between text-[10px] text-gray-400 mt-1">
                        <span>1 km</span>
                        <span>25 km</span>
                        <span>50 km</span>
                    </div>
                </div>

                <!-- Price Filter Slider -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-xs font-semibold text-slate-700">Harga Maksimal</label>
                        <span id="priceValue" class="text-xs font-bold text-brand-dark">Rp 1.000.000</span>
                    </div>
                    <input type="range" id="priceRange" min="50000" max="2000000" step="50000" value="1000000" oninput="updatePriceLabel(this.value)"
                        class="w-full accent-emerald-700 cursor-pointer">
                    <div class="flex justify-between text-[10px] text-gray-400 mt-1">
                        <span>Rp 50rb</span>
                        <span>Rp 1jt</span>
                        <span>Rp 2jt</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button onclick="resetFilters()" class="flex-1 py-2.5 border border-gray-300 text-slate-700 rounded-xl text-xs font-semibold hover:bg-gray-50">
                        Reset
                    </button>
                    <button onclick="applyFilters()" class="flex-1 py-2.5 btn-gradient rounded-xl text-xs font-bold shadow-sm">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Simple Alert / Toast Notification -->
        <div id="toast" class="absolute top-16 left-1/2 -translate-x-1/2 bg-slate-900/90 text-white text-xs px-4 py-2.5 rounded-full shadow-lg z-50 transition-opacity duration-300 opacity-0 pointer-events-none flex items-center gap-2">
            <i id="toastIcon" class="fa-solid fa-circle-check text-emerald-400"></i>
            <span id="toastMsg">Pesan tersimpan</span>
        </div>

    </div>

    <script>
        // Initial Mock Database
        let products = [
            {
                id: 1,
                title: "Jaket Denim Oversize Vintage",
                price: 185000,
                distance: 2.5,
                seller: "Ahmad Rizky",
                location: "Lowokwaru, Malang",
                image: "https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=600&q=80",
                description: "Jaket denim bekas berkualitas tinggi. Bahan tebal 14oz premium, warna washed blue masih pekat 90%. Ukuran L fit to XL (Panjang 68cm, Lebar Dada 58cm). Bebas noda, siap pakai langsung COD.",
                category: "Pakaian"
            },
            {
                id: 2,
                title: "Kaos Polo Katun Premium",
                price: 75000,
                distance: 4.1,
                seller: "Budi Santoso",
                location: "Sukun, Malang",
                image: "https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?auto=format&fit=crop&w=600&q=80",
                description: "Kaos Polo bahan pique cotton adem dan menyerap keringat. Warna Mustard. Ukuran Medium (M) Lebar dada 50cm, Panjang 70cm. Hanya pernah dipakai 2x untuk acara perkuliahan.",
                category: "Pakaian"
            },
            {
                id: 3,
                title: "Sepatu Sneaker Canvas Casual",
                price: 210000,
                distance: 1.2,
                seller: "Dian Sastro",
                location: "Klojen, Malang",
                image: "https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=600&q=80",
                description: "Sneaker lokal casual sol tebal tahan lama. Ukuran sepatu 42 (Insole 27 cm). Kondisi mulus 95%, insole masih empuk. Dijual karena kekecilan.",
                category: "Sepatu"
            },
            {
                id: 4,
                title: "Sweater Hoodie Fleece Grey",
                price: 120000,
                distance: 7.8,
                seller: "Eko Prasetyo",
                location: "Blimbing, Malang",
                image: "https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=600&q=80",
                description: "Hoodie abu-abu polos hangat dari bahan cotton fleece. Ukuran All Size Fit to L. Kondisi masih sangat bagus, karet pinggang dan lengan masih kencang.",
                category: "Pakaian"
            }
        ];

        let wishlist = [1]; // Product IDs saved
        let currentTab = 'home';
        let activeChatSeller = null;
        let selectedProductDetail = null;

        // Filter States
        let filterMaxDistance = 50;
        let filterMaxPrice = 2000000;

        // Initialize App
        window.onload = function() {
            renderPage();
            updateWishlistBadge();
        };

        function switchTab(tab, extraData = null) {
            currentTab = tab;
            
            // Highlight Navigation Icons
            ['home', 'wishlist', 'chat', 'sell'].forEach(t => {
                const el = document.getElementById(`nav-${t}`);
                if (el) {
                    if (t === tab) {
                        el.className = "flex flex-col items-center gap-1 text-brand-dark font-semibold transition";
                    } else {
                        el.className = "flex flex-col items-center gap-1 text-gray-400 hover:text-brand-dark font-medium transition";
                    }
                }
            });

            if (tab === 'chat' && extraData) {
                activeChatSeller = extraData;
            }

            renderPage();
        }

        // Render Current Page
        function renderPage() {
            const container = document.getElementById('mainContent');
            
            if (selectedProductDetail) {
                container.innerHTML = renderProductDetailPage(selectedProductDetail);
                return;
            }

            switch(currentTab) {
                case 'home':
                    container.innerHTML = renderHomePage();
                    break;
                case 'wishlist':
                    container.innerHTML = renderWishlistPage();
                    break;
                case 'chat':
                    container.innerHTML = renderChatPage();
                    break;
                case 'sell':
                    container.innerHTML = renderSellPage();
                    break;
            }
        }

        function renderHomePage() {
            // Apply Search and Slider Filters
            const searchTerm = (document.getElementById('searchInput')?.value || '').toLowerCase();
            const filtered = products.filter(p => {
                const matchSearch = p.title.toLowerCase().includes(searchTerm) || p.description.toLowerCase().includes(searchTerm);
                const matchDistance = p.distance <= filterMaxDistance;
                const matchPrice = p.price <= filterMaxPrice;
                return matchSearch && matchDistance && matchPrice;
            });

            let html = `
                <!-- Promo / Banner Banner Gradient 2 -->
                <div class="bg-gradient-brand p-4 rounded-2xl mb-5 shadow-sm relative overflow-hidden text-slate-900">
                    <div class="relative z-10">
                        <span class="bg-slate-900 text-brand-light text-[9px] font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">Aman & Praktis</span>
                        <h2 class="text-base font-bold mt-1 text-brand-deep">Transaksi Khusus COD</h2>
                        <p class="text-xs text-slate-800 mt-0.5 opacity-90">Cek fisik barang langsung & bayar di tempat tanpa kawatir.</p>
                    </div>
                    <i class="fa-solid fa-handshake absolute -right-3 -bottom-3 text-7xl opacity-20 text-brand-deep"></i>
                </div>

                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-sm text-slate-800">Barang Terdekat (${filtered.length})</h3>
                    <span class="text-[11px] text-gray-500">Maks. ${filterMaxDistance} km</span>
                </div>
            `;

            if (filtered.length === 0) {
                html += `
                    <div class="text-center py-12">
                        <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-2"></i>
                        <p class="text-xs text-gray-500">Tidak ada produk yang cocok dengan filter Anda.</p>
                        <button onclick="resetFilters()" class="mt-3 text-xs text-brand-dark font-bold underline">Reset Filter</button>
                    </div>
                `;
            } else {
                html += `<div class="grid grid-cols-2 gap-3.5">`;
                filtered.forEach(p => {
                    const isLiked = wishlist.includes(p.id);
                    html += `
                        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition cursor-pointer" onclick="openDetail(${p.id})">
                            <div class="relative aspect-square bg-gray-100">
                                <img src="${p.image}" alt="${p.title}" class="w-full h-full object-cover">
                                <button onclick="event.stopPropagation(); toggleWishlist(${p.id})" 
                                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-white/80 backdrop-blur-md flex items-center justify-center text-xs shadow-sm transition">
                                    <i class="${isLiked ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-gray-600'}"></i>
                                </button>
                                <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-md text-white text-[9px] px-1.5 py-0.5 rounded-md font-medium">
                                    <i class="fa-solid fa-location-arrow text-[8px] text-brand-light mr-0.5"></i> ${p.distance} km
                                </span>
                            </div>
                            <div class="p-2.5 flex flex-col flex-1 justify-between">
                                <div>
                                    <h4 class="text-xs font-semibold text-slate-800 line-clamp-2 mb-1">${p.title}</h4>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-brand-dark">Rp ${p.price.toLocaleString('id-ID')}</p>
                                    <p class="text-[10px] text-gray-400 mt-0.5 truncate">${p.location}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += `</div>`;
            }

            return html;
        }

        function renderWishlistPage() {
            const savedItems = products.filter(p => wishlist.includes(p.id));

            let html = `
                <div class="mb-4">
                    <h2 class="font-bold text-base text-slate-800">Wishlist & Barang Disimpan</h2>
                    <p class="text-xs text-gray-500">Pantau barang favorit yang ingin Anda beli langsung via COD.</p>
                </div>
            `;

            if (savedItems.length === 0) {
                html += `
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400 text-xl">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <p class="text-xs font-semibold text-gray-600">Belum ada barang di simpan</p>
                        <p class="text-[11px] text-gray-400 mt-1">Sukai barang di beranda untuk menyimpannya di sini.</p>
                        <button onclick="switchTab('home')" class="mt-4 px-4 py-2 btn-gradient text-xs rounded-xl shadow-sm">Cari Barang Sekarang</button>
                    </div>
                `;
            } else {
                html += `<div class="space-y-3">`;
                savedItems.forEach(p => {
                    html += `
                        <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm flex gap-3 cursor-pointer" onclick="openDetail(${p.id})">
                            <img src="${p.image}" class="w-20 h-20 rounded-xl object-cover bg-gray-100 flex-shrink-0">
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-xs font-semibold text-slate-800 line-clamp-1">${p.title}</h4>
                                        <button onclick="event.stopPropagation(); toggleWishlist(${p.id})" class="text-red-500 p-1">
                                            <i class="fa-solid fa-heart text-xs"></i>
                                        </button>
                                    </div>
                                    <p class="text-xs font-bold text-brand-dark mt-0.5">Rp ${p.price.toLocaleString('id-ID')}</p>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-gray-400">
                                    <span><i class="fa-solid fa-location-dot mr-0.5"></i> ${p.location}</span>
                                    <span class="bg-emerald-50 text-brand-dark font-medium px-2 py-0.5 rounded-full">COD Available</span>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += `</div>`;
            }

            return html;
        }

        function renderProductDetailPage(product) {
            const isLiked = wishlist.includes(product.id);

            return `
                <div class="bg-white -m-4 p-4 min-h-full">
                    <!-- Detail Header Top Bar -->
                    <div class="flex justify-between items-center mb-3">
                        <button onclick="closeDetail()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-slate-700">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                        </button>
                        <h3 class="font-bold text-xs text-slate-800">Detail Barang</h3>
                        <button onclick="toggleWishlist(${product.id})" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-slate-700">
                            <i class="${isLiked ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart'} text-xs"></i>
                        </button>
                    </div>

                    <!-- Image Showcase -->
                    <div class="relative rounded-2xl overflow-hidden bg-gray-100 aspect-square mb-4 shadow-sm">
                        <img src="${product.image}" class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-md text-brand-light text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center">
                            <i class="fa-solid fa-location-dot mr-1"></i> ${product.distance} km dari lokasi Anda
                        </span>
                    </div>

                    <!-- Price & Title -->
                    <div class="mb-4">
                        <div class="flex justify-between items-start mb-1">
                            <h2 class="text-sm font-bold text-slate-800 flex-1 pr-2">${product.title}</h2>
                            <span class="text-base font-extrabold text-brand-dark">Rp ${product.price.toLocaleString('id-ID')}</span>
                        </div>
                        <p class="text-[11px] text-gray-400 flex items-center">
                            <i class="fa-solid fa-store mr-1 text-slate-500"></i> Penjual: <span class="font-semibold text-slate-700 ml-1">${product.seller}</span> (${product.location})
                        </p>
                    </div>

                    <!-- COD Highlight Badge -->
                    <div class="bg-emerald-50 border border-emerald-200/60 p-3 rounded-xl mb-4 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-brand-dark text-brand-light flex items-center justify-center font-bold text-sm">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-brand-deep">Sistem Pembayaran: COD Only</p>
                            <p class="text-[10px] text-emerald-800">Ketemu langsung di lokasi, periksa barang, baru bayar tunai.</p>
                        </div>
                    </div>

                    <!-- Description Section (Size & Specs are inside here) -->
                    <div class="border-t border-gray-100 pt-3 mb-6">
                        <h4 class="text-xs font-bold text-slate-800 mb-1.5">Deskripsi & Spesifikasi Produk</h4>
                        <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line bg-gray-50 p-3 rounded-xl border border-gray-100">${product.description}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2 sticky bottom-0 bg-white pt-2">
                        <button onclick="startChat('${product.seller}', '${product.title}')" class="flex-1 py-3 border border-brand-dark text-brand-dark rounded-xl text-xs font-bold flex items-center justify-center gap-1.5 hover:bg-emerald-50 transition">
                            <i class="fa-solid fa-comments text-sm"></i>
                            Chat Penjual
                        </button>
                        <button onclick="buyNowCOD('${product.title}', '${product.seller}')" class="flex-[1.2] py-3 btn-gradient rounded-xl text-xs font-bold shadow-md flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-bag-shopping text-sm"></i>
                            Beli Sekarang (COD)
                        </button>
                    </div>
                </div>
            `;
        }

        function renderChatPage() {
            const defaultSeller = activeChatSeller || "Ahmad Rizky";
            
            return `
                <div class="flex flex-col h-[650px] -m-4 bg-white">
                    <!-- Chat Header -->
                    <div class="p-3 border-b border-gray-100 flex items-center gap-3 bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-brand-dark text-white font-bold flex items-center justify-center text-xs">
                            ${defaultSeller.charAt(0)}
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800">${defaultSeller}</h3>
                            <p class="text-[10px] text-emerald-600 font-medium"><i class="fa-solid fa-circle text-[8px] mr-1"></i> Online - Siap COD</p>
                        </div>
                    </div>

                    <!-- Chat History -->
                    <div id="chatBox" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50/50">
                        <div class="text-center my-2">
                            <span class="text-[9px] bg-gray-200 text-gray-600 px-2.5 py-1 rounded-full">Percakapan Keamanan COD</span>
                        </div>
                        
                        <div class="flex items-start gap-2">
                            <div class="bg-white p-3 rounded-2xl rounded-tl-none border border-gray-100 text-xs text-slate-700 max-w-[80%] shadow-sm">
                                Halo! Ada yang ingin ditanyakan tentang barang ini? Bisa nego halus atau janji ketemu lokasi COD di area Malang kota.
                            </div>
                        </div>

                        ${activeChatSeller ? `
                            <div class="flex items-start gap-2 justify-end">
                                <div class="bg-gradient-brand text-slate-900 p-3 rounded-2xl rounded-tr-none text-xs font-medium max-w-[80%] shadow-sm">
                                    Halo mas, apakah produk ini masih ada? Saya tertarik transaksi COD.
                                </div>
                            </div>
                        ` : ''}
                    </div>

                    <!-- Chat Input Box -->
                    <div class="p-3 border-t border-gray-100 bg-white flex items-center gap-2">
                        <input type="text" id="chatInput" placeholder="Tanyakan lokasi COD / kondisi barang..." 
                            class="flex-1 bg-gray-100 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:ring-1 focus:ring-brand-dark"
                            onkeypress="if(event.key === 'Enter') sendChatMessage()">
                        <button onclick="sendChatMessage()" class="w-9 h-9 btn-gradient rounded-xl flex items-center justify-center text-slate-900 shadow-sm">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </div>
                </div>
            `;
        }

        function renderSellPage() {
            return `
                <div class="bg-white -m-4 p-5 min-h-full">
                    <div class="mb-4">
                        <h2 class="font-bold text-base text-slate-800">Jual Barang Bekas/Baru</h2>
                        <p class="text-xs text-gray-500">Pasang iklan gratis dengan sistem pembayaran COD lokal.</p>
                    </div>

                    <form onsubmit="handleCreateProduct(event)" class="space-y-3.5">
                        <!-- Image Upload Preview Box -->
                        <div>
                            <label class="text-xs font-semibold text-slate-700 mb-1 block">Foto Produk</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center bg-gray-50 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition"
                                onclick="document.getElementById('fileInput').click()">
                                <i class="fa-solid fa-camera text-2xl text-brand-dark mb-1"></i>
                                <span class="text-xs text-gray-500 font-medium">Unggah Foto Produk</span>
                                <span class="text-[10px] text-gray-400">Gunakan foto jelas & asli</span>
                                <input type="file" id="fileInput" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div id="imagePreviewContainer" class="hidden mt-2 relative rounded-xl overflow-hidden h-32 bg-gray-100">
                                <img id="uploadedPreview" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <!-- Title -->
                        <div>
                            <label class="text-xs font-semibold text-slate-700 mb-1 block">Judul Barang</label>
                            <input type="text" id="inputTitle" required placeholder="Contoh: Jaket Parka Pria Hijau" 
                                class="w-full bg-gray-50 border border-gray-200 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:border-brand-dark">
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="text-xs font-semibold text-slate-700 mb-1 block">Harga Jual (Rp)</label>
                            <input type="number" id="inputPrice" required placeholder="Contoh: 150000" 
                                class="w-full bg-gray-50 border border-gray-200 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:border-brand-dark">
                        </div>

                        <!-- Location & Distance -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-xs font-semibold text-slate-700 mb-1 block">Area COD / Kecamatan</label>
                                <input type="text" id="inputLocation" required placeholder="Klojen, Malang" 
                                    class="w-full bg-gray-50 border border-gray-200 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:border-brand-dark">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-slate-700 mb-1 block">Estimasi Jarak (km)</label>
                                <input type="number" step="0.1" id="inputDistance" required placeholder="2.5" 
                                    class="w-full bg-gray-50 border border-gray-200 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:border-brand-dark">
                            </div>
                        </div>

                        <!-- Description (Where size/condition is specified) -->
                        <div>
                            <label class="text-xs font-semibold text-slate-700 mb-1 block">Deskripsi Barang (Sertukan Ukuran/Kondisi)</label>
                            <textarea id="inputDescription" rows="4" required placeholder="Tuliskan ukuran lengkap (misal XL, PxL), kondisi pemakaian, kelengkapan, dan tempat ajakan COD..." 
                                class="w-full bg-gray-50 border border-gray-200 text-xs px-3 py-2.5 rounded-xl focus:outline-none focus:border-brand-dark"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full py-3 btn-gradient text-xs font-bold rounded-xl shadow-md mt-2">
                            Tayangkan Barang (Sistem COD)
                        </button>
                    </form>
                </div>
            `;
        }

        function toggleWishlist(productId) {
            const index = wishlist.indexOf(productId);
            if (index > -1) {
                wishlist.splice(index, 1);
                showToast("Dihapus dari wishlist", "fa-regular fa-trash-can");
            } else {
                wishlist.push(productId);
                showToast("Disimpan ke wishlist", "fa-solid fa-heart text-red-500");
            }
            updateWishlistBadge();
            renderPage();
        }

        function updateWishlistBadge() {
            const badge = document.getElementById('wishlistBadge');
            if (badge) {
                if (wishlist.length > 0) {
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        }

        function openDetail(productId) {
            selectedProductDetail = products.find(p => p.id === productId);
            renderPage();
        }

        function closeDetail() {
            selectedProductDetail = null;
            renderPage();
        }

        function startChat(sellerName, itemTitle) {
            selectedProductDetail = null;
            switchTab('chat', sellerName);
        }

        function buyNowCOD(title, seller) {
            showToast("Pesanan dibuat! Silahkan obrolkan jadwal COD dengan penjual.", "fa-solid fa-handshake text-emerald-400");
            setTimeout(() => {
                startChat(seller, title);
            }, 1000);
        }

        function sendChatMessage() {
            const input = document.getElementById('chatInput');
            const box = document.getElementById('chatBox');
            if (!input || !input.value.trim()) return;

            const text = input.value.trim();
            const msgHtml = `
                <div class="flex items-start gap-2 justify-end">
                    <div class="bg-gradient-brand text-slate-900 p-3 rounded-2xl rounded-tr-none text-xs font-medium max-w-[80%] shadow-sm">
                        ${text}
                    </div>
                </div>
            `;
            box.insertAdjacentHTML('beforeend', msgHtml);
            input.value = '';
            box.scrollTop = box.scrollHeight;

            // Auto Reply Simulation
            setTimeout(() => {
                const replyHtml = `
                    <div class="flex items-start gap-2">
                        <div class="bg-white p-3 rounded-2xl rounded-tl-none border border-gray-100 text-xs text-slate-700 max-w-[80%] shadow-sm">
                            Baik mas, bisa COD di sekitar lokasi saya. Mau kapan jadinya?
                        </div>
                    </div>
                `;
                box.insertAdjacentHTML('beforeend', replyHtml);
                box.scrollTop = box.scrollHeight;
            }, 1200);
        }

        let uploadedImgUrl = "https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=600&q=80";

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadedImgUrl = e.target.result;
                    const preview = document.getElementById('uploadedPreview');
                    const container = document.getElementById('imagePreviewContainer');
                    if (preview && container) {
                        preview.src = uploadedImgUrl;
                        container.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        function handleCreateProduct(e) {
            e.preventDefault();
            const newProd = {
                id: Date.now(),
                title: document.getElementById('inputTitle').value,
                price: parseInt(document.getElementById('inputPrice').value),
                distance: parseFloat(document.getElementById('inputDistance').value) || 2.0,
                seller: "Saya (Penjual)",
                location: document.getElementById('inputLocation').value,
                image: uploadedImgUrl,
                description: document.getElementById('inputDescription').value,
                category: "Lainnya"
            };

            products.unshift(newProd);
            showToast("Barang berhasil ditayangkan!", "fa-solid fa-circle-check");
            switchTab('home');
        }

        function toggleFilterModal() {
            const modal = document.getElementById('filterModal');
            modal.classList.toggle('hidden');
        }

        function updateDistanceLabel(val) {
            document.getElementById('distanceValue').innerText = `${val} km`;
        }

        function updatePriceLabel(val) {
            document.getElementById('priceValue').innerText = `Rp ${parseInt(val).toLocaleString('id-ID')}`;
        }

        function applyFilters() {
            filterMaxDistance = parseFloat(document.getElementById('distanceRange').value);
            filterMaxPrice = parseInt(document.getElementById('priceRange').value);
            toggleFilterModal();
            renderPage();
            showToast("Filter diterapkan", "fa-solid fa-filter");
        }

        function resetFilters() {
            filterMaxDistance = 50;
            filterMaxPrice = 2000000;
            if (document.getElementById('distanceRange')) document.getElementById('distanceRange').value = 50;
            if (document.getElementById('priceRange')) document.getElementById('priceRange').value = 2000000;
            if (document.getElementById('distanceValue')) updateDistanceLabel(50);
            if (document.getElementById('priceValue')) updatePriceLabel(2000000);
            toggleFilterModal();
            renderPage();
        }

        function filterProducts() {
            if (currentTab === 'home') {
                renderPage();
            }
        }

        function showToast(msg, iconClass = "fa-solid fa-circle-check") {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMsg');
            const toastIcon = document.getElementById('toastIcon');

            toastMsg.innerText = msg;
            toastIcon.className = iconClass;

            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');

            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');
            }, 2500);
        }
    </script>
</body>
</html>