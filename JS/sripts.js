const products = document.querySelectorAll('.product');

// Добавляем обработчик событий для каждой карточки товара
products.forEach(product => {
  // Обработка события mouseenter (наведение на элемент)
  product.addEventListener('mouseenter', () => {
    // Добавляем класс с анимацией
    product.classList.add('hovered');
  });

  // Обработка события mouseleave (уход с элемента)
  product.addEventListener('mouseleave', () => {
    // Удаляем класс с анимацией
    product.classList.remove('hovered');
  });
});

