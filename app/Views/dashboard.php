<div class="container">

  <!-- Sidebar -->
  <?= $this->include('layouts/sidebar'); ?>

  <!-- Main Content -->
  <main class="main-content">
    <header class="header">
      <h1>Dashboard</h1>
      <div class="icons">
        <span>🔍</span>
        <span>🔔</span>
      </div>
    </header>

    <!-- Stats -->
    <section class="stats">
      <div class="card">
        <h3>Total Users</h3>
        <p>15</p>
      </div>
      <div class="card">
        <h3>Total Diagnostics</h3>
        <p>15</p>
      </div>
      <div class="card">
        <h3>Total Diseases</h3>
        <p>15</p>
      </div>
    </section>

    <!-- Content layout -->
    <section class="content">
      <div class="map">
        <h3>Farm Location</h3>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Map_of_Negros_Oriental.png/640px-Map_of_Negros_Oriental.png" 
             alt="Map" style="width:100%;border-radius:10px;">
      </div>

      <div class="users">
        <h3>Users</h3>
        <canvas id="userChart"></canvas>
      </div>

      <div class="new-users">
        <h3>New Users</h3>
        <ul>
          <li><img src="https://i.pravatar.cc/40?img=1" class="profile-pic"> Roselle Ehrman <span>Bacong</span></li>
          <li><img src="https://i.pravatar.cc/40?img=2" class="profile-pic"> Jone Smith <span>Tanjay</span></li>
          <li><img src="https://i.pravatar.cc/40?img=3" class="profile-pic"> Darron Handler <span>Bais</span></li>
          <li><img src="https://i.pravatar.cc/40?img=4" class="profile-pic"> Leatrice Kulik <span>Bais</span></li>
        </ul>
      </div>
    </section>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('userChart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Farmers', 'Users', 'Admins'],
      datasets: [{
        data: [50, 35, 15],
        backgroundColor: ['#e17055', '#00b894', '#d63031']
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: { color: '#fff' }
        }
      }
    }
  });
</script>
