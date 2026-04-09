
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vision Optique – Dashboard Administrateur</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Nunito', sans-serif; background: #f4f6f9; }
    h1, h2, h3, .brand { font-family: 'Nunito', serif; }

    /* Sidebar styles */
    .sidebar { transition: all 0.3s ease; }
    .sidebar-link {
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
    }
    .sidebar-link:hover { background: #1e3a6e10; border-left-color: #1e3a6e; }
    .sidebar-link.active {
      background: #1e3a6e10;
      border-left-color: #1e3a6e;
      color: #1e3a6e;
      font-weight: 600;
    }

    /* Card hover effect */
    .stat-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }

    /* Table styles */
    .admin-table tbody tr:hover {
      background: #f9fafb;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }
    .modal.active {
      display: flex;
    }
    .modal-content {
      background: white;
      border-radius: 16px;
      max-width: 500px;
      width: 90%;
      max-height: 85vh;
      overflow-y: auto;
    }

    /* Status badges */
    .status-badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      display: inline-block;
    }
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-confirmed { background: #d1fae5; color: #059669; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); position: fixed; z-index: 50; height: 100vh; overflow-y: auto; }
      .sidebar.mobile-open { transform: translateX(0); }
    }
  </style>
</head>
<body>

  <!-- Dashboard Container -->
  <div class="flex min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar w-72 bg-white shadow-lg flex-shrink-0" id="sidebar">
      <div class="p-6 border-b border-gray-200">
        <div class="flex items-center gap-2">
          <svg width="32" height="18" viewBox="0 0 32 18" fill="none">
            <rect x="1" y="4" width="12" height="10" rx="5" stroke="#1e3a6e" stroke-width="2"/>
            <rect x="19" y="4" width="12" height="10" rx="5" stroke="#1e3a6e" stroke-width="2"/>
            <line x1="13" y1="9" x2="19" y2="9" stroke="#1e3a6e" stroke-width="2"/>
          </svg>
          <span class="brand text-xl font-bold">
            <span class="font-light text-gray-700">Vision</span>
            <span class="text-[#1e3a6e]"> Optique</span>
          </span>
        </div>
        <p class="text-xs text-gray-500 mt-1">Panel Administrateur</p>
      </div>

      <nav class="p-4 space-y-1">
        <a href="{{ route('admin.dashboard')}}" data-section="dashboard" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700">
          <i class="fas fa-chart-line w-5"></i> <span>Tableau de bord</span>
        </a>
        <a href="#" data-section="appointments" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700">
          <i class="fas fa-calendar-check w-5"></i> <span>Rendez-vous</span>
          <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full" id="pendingCount">0</span>
        </a>
        <a href="#" data-section="messages" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700">
          <i class="fas fa-envelope w-5"></i> <span>Messages</span>
          <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full" id="unreadCount">0</span>
        </a>
        <a href="#" data-section="collections" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700">
          <i class="fas fa-glasses w-5"></i> <span>Collections</span>
        </a>
        <a href="#" data-section="settings" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700">
          <i class="fas fa-cog w-5"></i> <span>Paramètres</span>
        </a>
      </nav>

     
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 overflow-x-auto">
      <!-- Top Bar -->
      <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-40">
        <button id="mobileMenuBtn" class="lg:hidden text-gray-600 text-xl">
          <i class="fas fa-bars"></i>
        </button>
        <h1 class="text-xl font-bold text-gray-800" id="pageTitle">Tableau de bord</h1>
        <div class="flex items-center gap-4">
          <span class="text-sm text-gray-600 hidden sm:inline">Bienvenue, Administrateur</span>
          <i class="fas fa-bell text-gray-500 cursor-pointer hover:text-[#1e3a6e]"></i>
        </div>
      </header>

      <!-- Dynamic Content Area -->
      <div id="mainContent" class="p-6">
        <!-- Dashboard will be loaded here -->
      </div>
    </main>
  </div>

  <!-- Modal for edit/view -->
  <div id="modal" class="modal">
    <div class="modal-content p-6">
      <div id="modalBody"></div>
      <div class="flex justify-end gap-3 mt-4">
        <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Fermer</button>
      </div>
    </div>
  </div>

  <script>
    // ==================== DATA STORE ====================
    let appointments = [
      { id: 1, name: "Sophie Martin", email: "sophie@email.com", phone: "0612345678", date: "2026-04-10", time: "10:00", status: "pending", message: "Premier examen" },
      { id: 2, name: "Jean Dupont", email: "jean@email.com", phone: "0698765432", date: "2026-04-11", time: "14:30", status: "confirmed", message: "Nouvelle paire de lunettes" },
      { id: 3, name: "Marie Lambert", email: "marie@email.com", phone: "0745123456", date: "2026-04-12", time: "09:15", status: "pending", message: "Lentilles de contact" },
      { id: 4, name: "Pierre Dubois", email: "pierre@email.com", phone: "0632147859", date: "2026-04-13", time: "16:00", status: "cancelled", message: "Consultation" }
    ];

    let messages = [
      { id: 1, name: "Claire Rousseau", email: "claire@email.com", message: "Bonjour, je souhaite prendre rendez-vous pour un examen de vue. Merci !", date: "2026-04-05", read: false },
      { id: 2, name: "Thomas Lefevre", email: "thomas@email.com", message: "Quelles sont les marques de lunettes que vous proposez ?", date: "2026-04-04", read: false },
      { id: 3, name: "Isabelle Moreau", email: "isabelle@email.com", message: "Merci pour votre accueil, très satisfaite des services.", date: "2026-04-03", read: true },
      { id: 4, name: "Nicolas Bernard", email: "nicolas@email.com", message: "J'aimerais connaître les tarifs pour des verres progressifs.", date: "2026-04-02", read: false }
    ];

    let collections = [
      { id: 1, name: "Lunettes de Vue", image: "https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=400&q=80", active: true },
      { id: 2, name: "Lunettes de Soleil", image: "https://images.unsplash.com/photo-1508296695146-257a814070b4?w=400&q=80", active: true },
      { id: 3, name: "Lunettes Enfant", image: "https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=400&q=80", active: true }
    ];

    let settings = {
      siteName: "Vision Optique",
      address: "123 Rue de l'Optique, 75000 Paris",
      phone: "01 23 45 67 89",
      email: "info@visionoptique.fr",
      heroTitle: "Votre Vision, Notre Expertise",
      heroSubtitle: "Vos lunettes parfaites pour une vue optimale"
    };

    let currentSection = "dashboard";

    // Helper functions
    function updateCounters() {
      const pendingAppointments = appointments.filter(a => a.status === "pending").length;
      document.getElementById("pendingCount").innerText = pendingAppointments;
      const unreadMessages = messages.filter(m => !m.read).length;
      document.getElementById("unreadCount").innerText = unreadMessages;
    }

    function closeModal() {
      document.getElementById("modal").classList.remove("active");
    }

    function openModal(content) {
      document.getElementById("modalBody").innerHTML = content;
      document.getElementById("modal").classList.add("active");
    }

    // Render functions
    function renderDashboard() {
      const totalAppointments = appointments.length;
      const pendingAppointments = appointments.filter(a => a.status === "pending").length;
      const confirmedAppointments = appointments.filter(a => a.status === "confirmed").length;
      const unreadMessages = messages.filter(m => !m.read).length;
      const activeCollections = collections.filter(c => c.active).length;

      // Prepare chart data
      const months = ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun"];
      const appointmentsPerMonth = [12, 18, 22, 25, 30, appointments.length];

      const html = `
        <div class="space-y-6">
          
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
              <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Rendez-vous totaux</p><p class="text-3xl font-bold mt-2">${totalAppointments}</p></div>
                <i class="fas fa-calendar text-3xl text-[#1e3a6e] opacity-50"></i>
              </div>
            </div>
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
              <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">En attente</p><p class="text-3xl font-bold mt-2 text-orange-500">${pendingAppointments}</p></div>
                <i class="fas fa-clock text-3xl text-orange-500 opacity-50"></i>
              </div>
            </div>
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
              <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Confirmés</p><p class="text-3xl font-bold mt-2 text-green-600">${confirmedAppointments}</p></div>
                <i class="fas fa-check-circle text-3xl text-green-600 opacity-50"></i>
              </div>
            </div>
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
              <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Messages non lus</p><p class="text-3xl font-bold mt-2 text-blue-600">${unreadMessages}</p></div>
                <i class="fas fa-envelope text-3xl text-blue-600 opacity-50"></i>
              </div>
            </div>
          </div>

         

          <div class="bg-white rounded-xl p-5 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-3">Derniers rendez-vous</h3>
            <div class="overflow-x-auto">
              <table class="w-full text-sm">
                <thead class="border-b"><tr><th class="text-left py-2">Client</th><th class="text-left">Date</th><th class="text-left">Heure</th><th class="text-left">Statut</th></tr></thead>
                <tbody>
                  ${appointments.slice(0, 5).map(a => `
                    <tr class="border-b">
                      <td class="py-2">${a.name}</td><td>${a.date}</td><td>${a.time}</td>
                      <td><span class="status-badge status-${a.status}">${a.status === 'pending' ? 'En attente' : a.status === 'confirmed' ? 'Confirmé' : 'Annulé'}</span></td>
                    </tr>
                  `).join('')}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      `;
      document.getElementById("mainContent").innerHTML = html;
      
      // Initialize chart after DOM update
      setTimeout(() => {
        const ctx = document.getElementById('appointmentsChart');
        if (ctx) {
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: months,
              datasets: [{ label: 'Rendez-vous', data: appointmentsPerMonth, borderColor: '#1e3a6e', tension: 0.3, fill: false }]
            },
            options: { responsive: true, maintainAspectRatio: true }
          });
        }
      }, 100);
    }

    function renderAppointments() {
      const html = `
        <div class="space-y-4">
          <div class="flex justify-between items-center"><h2 class="text-2xl font-bold">Gestion des rendez-vous</h2></div>
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="admin-table w-full">
              <thead class="bg-gray-50 border-b">
                <tr><th class="p-3 text-left">Client</th><th class="p-3 text-left">Contact</th><th class="p-3 text-left">Date/Heure</th><th class="p-3 text-left">Message</th><th class="p-3 text-left">Statut</th><th class="p-3 text-left">Actions</th></tr>
              </thead>
              <tbody>
                ${appointments.map(a => `
                  <tr class="border-b">
                    <td class="p-3 font-medium">${a.name}</td>
                    <td class="p-3 text-sm">${a.email}<br>${a.phone}</td>
                    <td class="p-3">${a.date}<br>${a.time}</td>
                    <td class="p-3 text-sm max-w-xs truncate">${a.message || '-'}</td>
                    <td class="p-3">
                      <select onchange="updateAppointmentStatus(${a.id}, this.value)" class="text-sm border rounded px-2 py-1">
                        <option value="pending" ${a.status === 'pending' ? 'selected' : ''}>En attente</option>
                        <option value="confirmed" ${a.status === 'confirmed' ? 'selected' : ''}>Confirmé</option>
                        <option value="cancelled" ${a.status === 'cancelled' ? 'selected' : ''}>Annulé</option>
                      </select>
                    </td>
                    <td class="p-3"><button onclick="deleteAppointment(${a.id})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button></td>
                  </tr>
                `).join('')}
              </tbody>
            </table>
          </div>
        </div>
      `;
      document.getElementById("mainContent").innerHTML = html;
    }

    function renderMessages() {
      const html = `
        <div class="space-y-4">
          <h2 class="text-2xl font-bold">Messages reçus</h2>
          <div class="space-y-3">
            ${messages.map(m => `
              <div class="bg-white rounded-xl p-5 shadow-sm ${!m.read ? 'border-l-4 border-[#1e3a6e]' : ''}">
                <div class="flex justify-between items-start">
                  <div><strong>${m.name}</strong> <span class="text-sm text-gray-500">(${m.email})</span><p class="text-sm text-gray-500 mt-1">${m.date}</p></div>
                  <div><button onclick="toggleMessageRead(${m.id})" class="text-sm px-3 py-1 rounded ${m.read ? 'bg-gray-200' : 'bg-[#1e3a6e] text-white'}">${m.read ? 'Marquer non lu' : 'Marquer lu'}</button></div>
                </div>
                <p class="mt-3 text-gray-700">${m.message}</p>
                <button onclick="replyToMessage('${m.email}')" class="mt-3 text-sm text-[#1e3a6e] hover:underline"><i class="fas fa-reply"></i> Répondre</button>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      document.getElementById("mainContent").innerHTML = html;
    }

    function renderCollections() {
      const html = `
        <div class="space-y-4">
          <div class="flex justify-between items-center"><h2 class="text-2xl font-bold">Gestion des collections</h2><button onclick="addCollection()" class="bg-[#1e3a6e] text-white px-4 py-2 rounded-lg hover:bg-[#163060]"><i class="fas fa-plus"></i> Ajouter</button></div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            ${collections.map(c => `
              <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <img src="${c.image}" class="h-40 w-full object-cover" alt="${c.name}">
                <div class="p-4">
                  <h3 class="font-bold text-lg">${c.name}</h3>
                  <div class="flex justify-between items-center mt-3">
                    <button onclick="toggleCollectionStatus(${c.id})" class="text-sm px-3 py-1 rounded ${c.active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'}">${c.active ? 'Actif' : 'Inactif'}</button>
                    <button onclick="deleteCollection(${c.id})" class="text-red-500"><i class="fas fa-trash"></i></button>
                  </div>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      document.getElementById("mainContent").innerHTML = html;
    }

    function renderSettings() {
      const html = `
        <div class="space-y-4">
          <h2 class="text-2xl font-bold">Paramètres du site</h2>
          <div class="bg-white rounded-xl p-6 shadow-sm">
            <form onsubmit="saveSettings(event)">
              <div class="grid grid-cols-1 gap-4">
                <div><label class="block text-sm font-medium mb-1">Nom du site</label><input type="text" name="siteName" value="${settings.siteName}" class="w-full border rounded-lg p-2"></div>
                <div><label class="block text-sm font-medium mb-1">Adresse</label><input type="text" name="address" value="${settings.address}" class="w-full border rounded-lg p-2"></div>
                <div><label class="block text-sm font-medium mb-1">Téléphone</label><input type="text" name="phone" value="${settings.phone}" class="w-full border rounded-lg p-2"></div>
                <div><label class="block text-sm font-medium mb-1">Email</label><input type="email" name="email" value="${settings.email}" class="w-full border rounded-lg p-2"></div>
                <div><label class="block text-sm font-medium mb-1">Titre Hero</label><input type="text" name="heroTitle" value="${settings.heroTitle}" class="w-full border rounded-lg p-2"></div>
                <div><label class="block text-sm font-medium mb-1">Sous-titre Hero</label><input type="text" name="heroSubtitle" value="${settings.heroSubtitle}" class="w-full border rounded-lg p-2"></div>
                <button type="submit" class="bg-[#1e3a6e] text-white px-6 py-2 rounded-lg hover:bg-[#163060]">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      `;
      document.getElementById("mainContent").innerHTML = html;
    }

    // ==================== ACTIONS ====================
    window.updateAppointmentStatus = (id, status) => {
      const apt = appointments.find(a => a.id === id);
      if (apt) apt.status = status;
      updateCounters();
      renderAppointments();
    };

    window.deleteAppointment = (id) => {
      if (confirm("Supprimer ce rendez-vous ?")) {
        appointments = appointments.filter(a => a.id !== id);
        updateCounters();
        renderAppointments();
      }
    };

    window.toggleMessageRead = (id) => {
      const msg = messages.find(m => m.id === id);
      if (msg) msg.read = !msg.read;
      updateCounters();
      renderMessages();
    };

    window.replyToMessage = (email) => {
      window.location.href = `mailto:${email}`;
    };

    window.toggleCollectionStatus = (id) => {
      const coll = collections.find(c => c.id === id);
      if (coll) coll.active = !coll.active;
      renderCollections();
    };

    window.deleteCollection = (id) => {
      if (confirm("Supprimer cette collection ?")) {
        collections = collections.filter(c => c.id !== id);
        renderCollections();
      }
    };

    window.addCollection = () => {
      const name = prompt("Nom de la collection :");
      if (name) {
        const newId = Math.max(...collections.map(c => c.id), 0) + 1;
        collections.push({ id: newId, name, image: "https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=400&q=80", active: true });
        renderCollections();
      }
    };

    function saveSettings(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      settings.siteName = formData.get("siteName");
      settings.address = formData.get("address");
      settings.phone = formData.get("phone");
      settings.email = formData.get("email");
      settings.heroTitle = formData.get("heroTitle");
      settings.heroSubtitle = formData.get("heroSubtitle");
      alert("Paramètres enregistrés !");
    }

    // Navigation
    function loadSection(section) {
      currentSection = section;
      if (section === "dashboard") renderDashboard();
      else if (section === "appointments") renderAppointments();
      else if (section === "messages") renderMessages();
      else if (section === "collections") renderCollections();
      else if (section === "settings") renderSettings();
      
      // Update active link
      document.querySelectorAll(".sidebar-link").forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("data-section") === section) link.classList.add("active");
      });
      
      const titles = { dashboard: "Tableau de bord", appointments: "Rendez-vous", messages: "Messages", collections: "Collections", settings: "Paramètres" };
      document.getElementById("pageTitle").innerText = titles[section] || "Dashboard";
    }

    // Event listeners
    document.querySelectorAll(".sidebar-link").forEach(link => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        const section = link.getAttribute("data-section");
        loadSection(section);
        if (window.innerWidth < 1024) document.getElementById("sidebar").classList.remove("mobile-open");
      });
    });

    document.getElementById("mobileMenuBtn").addEventListener("click", () => {
      document.getElementById("sidebar").classList.toggle("mobile-open");
    });

    // Initialize
    updateCounters();
    loadSection("dashboard");
  </script>
</body>
</html>