// public/js/sport-category.js

// Daftar kategori olahraga
const sportCategories = [
    "Semua","Badminton", "Sepak Bola", "Bola Basket", "Bola Voli",
    "Balap Sepeda", "Atletik", "Renang", "Tinju", "Pencak Silat","Futsal","Catur","Tenis Meja","Angkat Besi","Berkuda","Gulat","Menembak","Motor Balap","Panahan",
  ];

  // Simulate the Auth user and coach object (you would typically get this data from the server)
const authUser = {
  level: 'Pengurus Cabor Sepak Bola' // Example user level, this should come from your actual session
};

const coach = {
  sport_category: 'Sepak Bola' // Example sport category, this should come from your actual data
};

// Fungsi untuk mengecek akses pengguna berdasarkan level dan kategori olahraga
function canAccessSportCategory(userLevel, coachCategory) {
  if (userLevel === 'Admin') {
    return true;
  }

  const sportCategoryAccess = {
    'Pengurus Cabor Sepak Bola': 'Sepak Bola',
    'Pengurus Cabor Badminton': 'Badminton',
    'Pengurus Cabor Bola Voli': 'Bola Voli',
    'Pengurus Cabor Bola Basket': 'Bola Basket',
    'Pengurus Cabor Atletik': 'Atletik',
    'Pengurus Cabor Renang': 'Renang',
    'Pengurus Cabor Tinju': 'Tinju',
    'Pengurus Cabor Futsal': 'Futsal',
    'Pengurus Cabor Pencak Silat': 'Pencak Silat',
    'Pengurus Cabor Futsal': 'Futsal',
    'Pengurus Cabor Catur': 'Catur',
    'Pengurus Cabor Tenis Meja': 'Tenis Meja',
    'Pengurus Cabor Angkat Besi': 'Angkat Besi',
    'Pengurus Cabor Berkuda': 'Berkuda',
    'Pengurus Cabor Gulat': 'Gulat',
    'Pengurus Cabor Menembak': 'Menembak',
    'Pengurus Cabor Motor Balap': 'Motor Balap',
    'Pengurus Cabor Panahan': 'Panahan',
  };

  return userLevel === 'Pengurus Cabor ' + coachCategory && sportCategoryAccess[userLevel] === coachCategory;
}
  
  // Fungsi untuk mengisi elemen select dengan kategori olahraga
  function populateSportCategorySelect(el) {      
    sportCategories.forEach(category => {
      const option = document.createElement('option');
      option.value = category;
      option.textContent = category;
      el.appendChild(option);
    });
  }
  
  // Panggil fungsi untuk setiap dropdown setelah konten dimuat
  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.sport-category-select').forEach(select => {
      populateSportCategorySelect(select);
    });
  });
  
  const sportCategoryCount = sportCategories.length;

// Tampilkan jumlah kategori di elemen dashboard jika ada
document.addEventListener("DOMContentLoaded", () => {
    const categoryCountElement = document.getElementById('sportCategoryCount');
    if (categoryCountElement) {
        categoryCountElement.textContent = sportCategoryCount;
    }
});

// Daftar level/pengurus
const sportCategoryAccessLevels = [
  'Admin',
  'Pengurus Cabor Sepak Bola',
  'Pengurus Cabor Badminton',
  'Pengurus Cabor Bola Basket',
  'Pengurus Cabor Bola Voli',
  'Pengurus Cabor Atletik',
  'Pengurus Cabor Renang',
  'Pengurus Cabor Tinju',
  'Pengurus Cabor Pencak Silat',
  'Pengurus Cabor Futsal',
  'Pengurus Cabor Catur',
  'Pengurus Cabor Tenis Meja',
  'Pengurus Cabor Angkat Besi',
  'Pengurus Cabor Berkuda',
  'Pengurus Cabor Gulat',
  'Pengurus Cabor Menembak',
  'Pengurus Cabor Motor Balap',
  'Pengurus Cabor Panahan',
];

// Fungsi untuk mengisi elemen select dengan level/pengurus
function populateUserLevelSelect(selectId) {
  const selectElement = document.getElementById(selectId);
  if (selectElement) {
      sportCategoryAccessLevels.forEach(level => {
          const option = document.createElement('option');
          option.value = level;
          option.textContent = level;
          selectElement.appendChild(option);
      });
  }
}

// Panggil fungsi untuk select level setelah konten dimuat
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('.user-level-select').forEach(select => {
      populateUserLevelSelect(select.id);
  });
});



