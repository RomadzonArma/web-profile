const faq = document.getElementById('faq');
const faqWrapper = document.querySelector('.faq-wrapper')
function faqShow(){
  faqWrapper.classList.toggle('show');
}
faq.addEventListener('click', faqShow)