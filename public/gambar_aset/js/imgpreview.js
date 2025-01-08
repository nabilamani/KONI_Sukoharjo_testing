function previewImage() {
  const fileInput = document.getElementById('gambar');
  const preview = document.getElementById('preview');
  
  if (fileInput.files && fileInput.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.classList.remove('d-none');
    };
    reader.readAsDataURL(fileInput.files[0]);
  }
}

function previewNewPhoto() {
  const fileInput = document.getElementById('photo');
  const preview = document.getElementById('photo-preview');
  const noPhotoText = document.getElementById('no-photo-text');

  if (fileInput.files && fileInput.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('d-none');
          noPhotoText.classList.add('d-none');
      };
      reader.readAsDataURL(fileInput.files[0]);
  } else {
      preview.src = '#';
      preview.classList.add('d-none');
      noPhotoText.classList.remove('d-none');
  }
}