<?php
header('Content-Type: application/javascript; charset=utf-8');
?>
content = document.getElementsByClassName("content-wrapper")[0];
console.log(content.className);

const viewClass = Array.from(content.classList).find(c => c.startsWith('view-'));

if (viewClass && viewClass.contains('view-')) {
    const viewName = viewClass.replace('view-', '');

    // find all nav li elements
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(li => {
        // default: remove active
        li.classList.remove('active');
        const a = li.querySelector('a');
        if (!a) return;
        const href = a.getAttribute('href') || '';
        // if href contains the view name, mark active
        if (viewName !== '' && href.indexOf(viewName) !== -1) {
            li.classList.add('active');
        }
    });
}