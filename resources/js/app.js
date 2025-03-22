import "./bootstrap";
import Chart from 'chart.js/auto';

window.Chart = Chart;

const asideButton = document.getElementById('aside-button');
const dashboardBody = document.querySelector('.db-body');

if(localStorage.getItem('isExtender') === 'true') {
    dashboardBody.classList.add('sb-extender');
}

asideButton.addEventListener('click', () => {
    let isExtenderClass = dashboardBody.classList.toggle('sb-extender');
    localStorage.setItem('isExtender', isExtenderClass);
});