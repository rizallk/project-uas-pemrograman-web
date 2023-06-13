function _(el) {
  const element = document.querySelectorAll(el);
  if (element.length > 1) {
    return document.querySelectorAll(el);
  } else {
    return document.querySelector(el);
  }
}

// Alert custom
if (_('.alert')) {
  _('.alert .close').addEventListener('click', function () {
    _('.alert').style.opacity = '0';
    setTimeout(() => {
      _('.alert').style.display = 'none';
    }, 1000);
  });
  setTimeout(() => {
    _('.alert').style.opacity = '0';
    setTimeout(() => {
      _('.alert').style.display = 'none';
    }, 1000);
  }, 5000);
}

// Menu Dropdown
if (_('.menu-dropdown')) {
  if (_('.menu-dropdown').length > 0) {
    for (const menuDropdown of _('.menu-dropdown')) {
      menuDropdown.addEventListener('mouseover', function () {
        this.children[0].style.transform = 'rotate(-90deg)';
      });

      menuDropdown.addEventListener('mouseout', function () {
        this.children[0].style.transform = 'rotate(0deg)';
      });
    }

    for (const subMenuDropdown of _('.submenu-dropdown')) {
      subMenuDropdown.addEventListener('mouseover', function () {
        this.previousElementSibling.children[0].style.transform =
          'rotate(-90deg)';
      });

      subMenuDropdown.addEventListener('mouseout', function () {
        this.previousElementSibling.children[0].style.transform =
          'rotate(0deg)';
      });
    }
  } else {
    _('.menu-dropdown').addEventListener('mouseover', function () {
      this.children[0].style.transform = 'rotate(-90deg)';
    });

    _('.menu-dropdown').addEventListener('mouseout', function () {
      this.children[0].style.transform = 'rotate(0deg)';
    });

    _('.submenu-dropdown').addEventListener('mouseover', function () {
      this.previousElementSibling.children[0].style.transform =
        'rotate(-90deg)';
    });

    _('.submenu-dropdown').addEventListener('mouseout', function () {
      this.previousElementSibling.children[0].style.transform = 'rotate(0deg)';
    });
  }
}

// Sidebar Toggle
if (_('.sidebar')) {
  _('.sidebar-toggle-open').addEventListener('click', function () {
    _('.sidebar').classList.add('open');
    _('.bg-overlay').classList.add('overlay');
  });

  _('.bg-overlay').addEventListener('click', function () {
    _('.sidebar').classList.remove('open');
    _('.bg-overlay').classList.remove('overlay');
  });
}

// Show Password
if (_('#show-pw')) {
  _('#show-pw').addEventListener('click', function () {
    if (_('#password').type === 'password') {
      _('#password').type = 'text';
    } else {
      _('#password').type = 'password';
    }
  });
}

// Delete handle
if (_('#delete')) {
  if (_('#delete').length > 1) {
    for (let i = 0; i < _('#delete').length; i++) {
      const el1 = _('#delete')[i];
      const el2 = _('#del-form')[i];
      el1.addEventListener('click', function (e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin?')) {
          el2.submit();
        }
      });
    }
  } else {
    _('#delete').addEventListener('click', function (e) {
      e.preventDefault();
      if (confirm('Apakah Anda yakin?')) {
        _('#del-form').submit();
      }
    });
  }
}

// Waktu cetak aset
if (_('#waktu')) {
  _('#waktu').innerHTML = `Dicetak pada ${new Date().toLocaleString()}`;
}

// Form validasi info
if (_('.form-group .info')) {
  if (_('#username')) {
    if (_('#username').nextElementSibling.classList.value === 'info') {
      _('#username').addEventListener('focus', function () {
        this.nextElementSibling.classList.add('show');
      });
      _('#username').addEventListener('blur', function () {
        this.nextElementSibling.classList.remove('show');
      });
    }
  }
  if (_('#password')) {
    if (_('#password').nextElementSibling.classList.value === 'info') {
      _('#password').addEventListener('focus', function () {
        this.nextElementSibling.classList.add('show');
      });
      _('#password').addEventListener('blur', function () {
        this.nextElementSibling.classList.remove('show');
      });
    }
  }
}
