<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard Smart Parking</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body class="bg-gray-100">

  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard Monitoring Parking Slot</h1>
    <div x-data="parkingChart()" x-init="init()">
      <div class="flex items-center space-x-3 mb-6">
        <label class="font-semibold">Tampilkan:</label>
        <select x-model="filter" @change="fetchData()" class="border rounded px-3 py-1">
          <option value="isi">Terisi</option>
          <option value="kosong">Kosong</option>
        </select>
      </div>
      <div class="bg-white p-4 rounded shadow">
        <canvas id="parkingChartCanvas"></canvas>
      </div>
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <template x-for="(st, i) in currentStatus" :key="i">
          <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-xl font-bold mb-2" x-text="`Slot ${i+1}`"></h2>
            <p 
              class="text-2xl font-semibold" 
              x-text="st ? 'Isi' : 'Kosong'"
              :class="st ? 'text-red-500' : 'text-green-500'">
            </p>
          </div>
        </template>
      </div>
    </div>
  </div>

  <script>
    function parkingChart() {
      return {
        filter: 'isi',             
        chart: null,                
        labels: [],               
        dataSlots: { slot1: [], slot2: [], slot3: [] },
        currentStatus: [false,false,false],

        init() {
          const ctx = document.getElementById('parkingChartCanvas');
          this.chart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: this.labels,
              datasets: [
                {
                  label: 'Slot 1',
                  data: this.dataSlots.slot1,
                  borderColor: '#F59E0B',      // kuning
                  backgroundColor: 'transparent',
                },
                {
                  label: 'Slot 2',
                  data: this.dataSlots.slot2,
                  borderColor: '#6366F1',      // biru
                  backgroundColor: 'transparent',
                },
                {
                  label: 'Slot 3',
                  data: this.dataSlots.slot3,
                  borderColor: '#EF4444',      // merah
                  backgroundColor: 'transparent',
                },
              ]
            },
            options: {
              scales: {
                x: {
                  title: { display: true, text: 'Hari' },
                },
                y: {
                  max: 24,
                  title: { display: true, text: 'Jam (0-24)' },
                }
              },
              plugins: {
                legend: { position: 'bottom' }
              },
              elements: {
                point: { radius: 4 }
              }
            }
          });

          this.fetchData();
        },

        fetchData() {
          fetch(`/api/slots/daily-hours?status=${this.filter}`)
            .then(res => res.json())
            .then(json => {
              this.labels        = json.days;
              this.dataSlots     = json.slots;
              this.currentStatus = json.currentStatus.map(s => s === 1);
              this.updateChart();
            })
            .catch(err => console.error(err));
        },

        updateChart() {
          this.chart.data.labels = this.labels;
          this.chart.data.datasets[0].data = this.dataSlots.slot1;
          this.chart.data.datasets[1].data = this.dataSlots.slot2;
          this.chart.data.datasets[2].data = this.dataSlots.slot3;
          this.chart.update();
        }
      }
    }
  </script>

</body>
</html>
