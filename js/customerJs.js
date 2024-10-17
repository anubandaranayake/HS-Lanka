// SIDEBAR MENU FOR CUSTOMER
const allCustomerMenu = document.querySelectorAll('#customerSidebar .side-menu.top li a');

allCustomerMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allCustomerMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    });
});

// TOGGLE SIDEBAR FOR CUSTOMER
const customerMenuBar = document.querySelector('#content nav .bx.bx-menu');
const customerSidebar = document.getElementById('customerSidebar');

customerMenuBar.addEventListener('click', function () {
    customerSidebar.classList.toggle('hide');
});
