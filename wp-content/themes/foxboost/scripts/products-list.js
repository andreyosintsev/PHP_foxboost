document.addEventListener('DOMContentLoaded', () => {
    const productItems = document.querySelectorAll('.product-item');
    const productItemTitles = document.querySelectorAll('.product-item__title');

    collapseAllItems(productItems);
 
    productItemTitles.forEach(productItemTitle => productItemTitle.addEventListener('click', (e) => {
        collapseAllItems(productItems);
        expandItem(productItemTitle);
    }))
})

function collapseAllItems(productItems) {
    if (!productItems) {
        console.error('DOM: products-list: .product-items не найдены');
        return;
    }
    productItems.forEach(productItem => productItem.classList.remove('product-item_expanded'));    
}

function expandItem(productItemTitle) {
    if (!productItemTitle) {
        console.error('DOM: products-list: .product-item__title не найден');
        return;
    }
    
    const productItem = productItemTitle.parentElement;
    if (!productItem) {
        console.error('DOM: products-list: .product-item не найден');
        return;
    }

    productItem.classList.add('product-item_expanded');
}
