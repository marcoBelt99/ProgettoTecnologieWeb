    var timeOutValue = 100;      // SET TIMEOUT (IN MILISECONDS).
    var setTimeToHide_ID, mItem;

    function showmenu(obj) {
        if (mItem) mItem.style.display = 'none';

        mItem = document.getElementById(obj);
        mItem.style.display = 'block';
    }
    // SET TIME TO HIDE MENU LIST.
    function setTimeToHide() { 
        setTimeToHide_ID = window.setTimeout(HideMenu, timeOutValue); 
    }

    function HideMenu() { 
        if (mItem) mItem.style.display = 'none'; 
    }       // HIDE THE MENU LIST AFTER A SPECIFIED TIME.

    function ReSetTimer() {
        if (setTimeToHide_ID) {
            window.clearTimeout(setTimeToHide_ID);
            setTimeToHide_ID = 0;
        }
    };
