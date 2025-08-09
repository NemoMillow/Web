// Popup Lomba: animasi, close, tampil hanya di index.php
window.addEventListener('DOMContentLoaded', function() {
    var popup = document.getElementById('popup-lomba');
    var closeBtn = document.getElementById('popupLombaClose');
    if (!popup) return;
    // Cek localStorage agar popup tidak muncul lagi setelah close (optional, bisa dihapus jika ingin selalu muncul)
  
    // Animasi muncul sudah di-handle CSS
    closeBtn.onclick = function() {
      popup.classList.add('popup-lomba-hide');
      setTimeout(function() {
        popup.style.display = 'none';
  
      }, 350);
    };
  
    // DRAG & DROP
    var isDragging = false, offsetX = 0, offsetY = 0;
    var startX, startY, lastX, lastY, lastTime, velocityX = 0, velocityY = 0;
    var content = popup.querySelector('.popup-lomba-content');
    content.style.cursor = 'move';
  
    function setPopupTransition(val) {
      popup.style.transition = val;
    }
  
    function onMouseDown(e) {
      isDragging = true;
      setPopupTransition('none');
      startX = lastX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
      startY = lastY = e.type === 'touchstart' ? e.touches[0].clientY : e.clientY;
      lastTime = Date.now();
      var rect = popup.getBoundingClientRect();
      offsetX = startX - rect.left;
      offsetY = startY - rect.top;
      document.addEventListener('mousemove', onMouseMove);
      document.addEventListener('mouseup', onMouseUp);
      document.addEventListener('touchmove', onMouseMove, {passive:false});
      document.addEventListener('touchend', onMouseUp);
    }
  
    function onMouseMove(e) {
      if (!isDragging) return;
      var x = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
      var y = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;
      var now = Date.now();
      velocityX = (x - lastX) / (now - lastTime + 1) * 16; // px per frame
      velocityY = (y - lastY) / (now - lastTime + 1) * 16;
      lastX = x; lastY = y; lastTime = now;
      popup.style.left = (x - offsetX) + 'px';
      popup.style.top = (y - offsetY) + 'px';
      popup.style.right = 'auto';
      popup.style.bottom = 'auto';
      popup.style.position = 'fixed';
      e.preventDefault();
    }
  
    function onMouseUp(e) {
      isDragging = false;
      document.removeEventListener('mousemove', onMouseMove);
      document.removeEventListener('mouseup', onMouseUp);
      document.removeEventListener('touchmove', onMouseMove);
      document.removeEventListener('touchend', onMouseUp);
      // Lempar inertia jika swipe cepat
      var throwDist = 0, throwX = 0, throwY = 0;
      var speed = Math.sqrt(velocityX*velocityX + velocityY*velocityY);
      if (speed > 2) { // threshold kecepatan
        throwDist = Math.min(200, speed * 30); // max lempar 200px
        throwX = velocityX / speed * throwDist;
        throwY = velocityY / speed * throwDist;
        var rect = popup.getBoundingClientRect();
        var winW = window.innerWidth, winH = window.innerHeight;
        var popupW = rect.width, popupH = rect.height;
        var targetLeft = rect.left + throwX;
        var targetTop = rect.top + throwY;
        // Bounce ke tepi layar
        if (targetLeft < 0) {
          targetLeft = 0 + 10;
          velocityX = -velocityX * 0.5;
        } else if (targetLeft + popupW > winW) {
          targetLeft = winW - popupW - 10;
          velocityX = -velocityX * 0.5;
        }
        if (targetTop < 0) {
          targetTop = 0 + 10;
          velocityY = -velocityY * 0.5;
        } else if (targetTop + popupH > winH) {
          targetTop = winH - popupH - 10;
          velocityY = -velocityY * 0.5;
        }
        // ROTATE animasi saat lempar
        var angle = Math.max(-25, Math.min(25, velocityX * 2)); // derajat rotasi
        popup.style.transform = 'rotate(' + angle + 'deg)';
        setPopupTransition('left 0.7s cubic-bezier(.22,1.2,.36,1), top 0.7s cubic-bezier(.22,1.2,.36,1), transform 0.7s cubic-bezier(.22,1.2,.36,1)');
        popup.style.left = targetLeft + 'px';
        popup.style.top = targetTop + 'px';
        setTimeout(function(){
          // Jika mantul, animasi balik sedikit (bounce)
          if (Math.abs(velocityX) > 1 || Math.abs(velocityY) > 1) {
            var bounceLeft = targetLeft + velocityX * 8;
            var bounceTop = targetTop + velocityY * 8;
            // Batasi bounce agar tidak keluar layar
            bounceLeft = Math.max(10, Math.min(winW - popupW - 10, bounceLeft));
            bounceTop = Math.max(10, Math.min(winH - popupH - 10, bounceTop));
            setPopupTransition('left 0.25s cubic-bezier(.45,1.8,.36,1), top 0.25s cubic-bezier(.45,1.8,.36,1), transform 0.25s cubic-bezier(.45,1.8,.36,1)');
            popup.style.left = bounceLeft + 'px';
            popup.style.top = bounceTop + 'px';
            popup.style.transform = 'rotate(0deg)';
            setTimeout(function(){ setPopupTransition('none'); }, 250);
          } else {
            popup.style.transform = 'rotate(0deg)';
            setPopupTransition('none');
          }
        }, 700);
      } else {
        setPopupTransition('left 0.3s cubic-bezier(.4,1.6,.36,1), top 0.3s cubic-bezier(.4,1.6,.36,1)');
        setTimeout(function(){ setPopupTransition('none'); }, 300);
      }
    }
  
    content.addEventListener('mousedown', onMouseDown);
    content.addEventListener('touchstart', onMouseDown, {passive:false});
  });
  