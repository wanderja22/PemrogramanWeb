document.addEventListener('DOMContentLoaded', function() {
    let modalbox = document.getElementById("modalbox");

    function showModal() {
        setTimeout(() => {
            modalbox.style.display = "block";
        }, 250);
    }

    function closeModal() {
        modalbox.style.display = "none";
    }
    showModal();
    const acceptButton = document.getElementById('acceptButton');
    acceptButton.addEventListener('click', closeModal);
    const closeModalButtons = document.querySelectorAll('.close-logo');
    closeModalButtons.forEach(button => {
    button.addEventListener('click', closeModal);
});

    const themeToggle = document.getElementById('themeToggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        themeToggle.checked = true;
    }

    themeToggle.addEventListener('change', () => {
        if (themeToggle.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    });

    const addToCartButtons = document.querySelectorAll('.product button');
    function addToCartHandler() {
        const productName = this.parentElement.querySelector('h3').innerText;
        alert(`Product ${productName} has been added to your cart!`);
    }

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCartHandler);
    });

    const colors = ['#ffcc33', '#ff6347', '#ffa500', '#ffd700', '#ff4500', '#ff69b4', '#9370db', '#00ced1', '#20b2aa'];

    function getRandomColorIndex() {
        return Math.floor(Math.random() * colors.length);
    }

    function changeTextColor() {
        const welcomeText = document.getElementById('welcomeText');
        const randomColorIndex = getRandomColorIndex();
        const randomColor = colors[randomColorIndex];
        welcomeText.style.color = randomColor;
    }

    changeTextColor();

    const aboutMeText = document.getElementById('aboutMeText');
    aboutMeText.addEventListener('click', function() {
        const randomColorIndex = getRandomColorIndex();
        const randomColor = colors[randomColorIndex];
        aboutMeText.style.color = randomColor;
    });

    const orderButton = document.getElementById('orderButton');
    const orderModal = document.getElementById('orderDetailsModal');
    const closeModalButton = document.querySelector('.modal .close');

    orderButton.addEventListener('click', function() {
        orderModal.style.display = 'block';
    });

    closeModalButton.addEventListener('click', function() {
        orderModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === orderModal) {
            orderModal.style.display = 'none';
        }
    });

    const orderForm = document.getElementById('orderForm');
    function handleFormSubmission(event) {
        event.preventDefault();
        const customerName = document.getElementById('customerName').value;
        const fruitType = document.getElementById('fruitType').value;
        const quantity = document.getElementById('quantity').value;
        const whatsappNumber = document.getElementById('whatsappNumber').value;

        // Menampilkan deskripsi pesanan di dalam modal
        const orderDescriptionElement = document.getElementById('orderDescription');
        orderDescriptionElement.innerHTML = `
            <h3>Pesanan Anda:</h3>
            <p><strong>Nama Pemesan:</strong> ${customerName}</p>
            <p><strong>Buah yang Dipesan:</strong> ${fruitType}</p>
            <p><strong>Jumlah Buah yang Dipesan:</strong> ${quantity}</p>
            <p><strong>Nomor WhatsApp:</strong> ${whatsappNumber}</p>
        `;
        showOrders();
        orderModal.style.display = 'none';
        orderForm.reset();
    }

    function showOrders() {
        const orderDescription = document.getElementById('orderDescription');
        const orderList = document.getElementById('orderList');
        const orders = Array.from(orderList.children).map(li => li.textContent).join('\n');
        orderDescription.textContent = orders;
    }

    orderForm.addEventListener('submit', handleFormSubmission);
});