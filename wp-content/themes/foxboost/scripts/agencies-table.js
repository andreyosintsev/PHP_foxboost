document.addEventListener("DOMContentLoaded", () => {
    const expandinfos = document.querySelectorAll('.agencies-table__expandinfo');
    const infos = document.querySelectorAll('.agencies-table__cell_info');

    expandinfos.forEach(expandinfo => expandinfo.addEventListener('click', clickHandler));
    
    function clickHandler(e) {
        const reg = e.currentTarget.dataset.reg;

        expandinfos.forEach(expandinfo => expandinfo.classList.remove('agencies-table__expandinfo_expanded'));
        e.currentTarget.classList.add('agencies-table__expandinfo_expanded');
        
        infos.forEach(info => {
            if (info.dataset.reg == reg) 
                info.classList.remove("agencies-table__cell_hidden");
            else info.classList.add("agencies-table__cell_hidden");
        });
    }
});