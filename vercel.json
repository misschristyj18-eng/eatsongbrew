const STORAGE_KEY = 'eatSongBrewState';

const emptyState = () => ({
  users: [
    {
      id: 1,
      name: 'Admin User',
      email: 'admin@eatsongbrew.com',
      password: 'admin123',
      role: 'admin'
    }
  ],
  orders: [],
  currentUserId: null
});

function getState() {
  const raw = localStorage.getItem(STORAGE_KEY);
  if (!raw) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(emptyState()));
    return emptyState();
  }

  try {
    return JSON.parse(raw);
  } catch (error) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(emptyState()));
    return emptyState();
  }
}

function saveState(state) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
}

function getCurrentUser() {
  const state = getState();
  return state.users.find((user) => user.id === state.currentUserId) || null;
}

function setCurrentUser(userId) {
  const state = getState();
  state.currentUserId = userId;
  saveState(state);
}

function setFlash(elementId, message, type = 'error') {
  const el = document.getElementById(elementId);
  if (!el) return;

  el.textContent = message;
  el.classList.remove('hidden');
  el.classList.remove('error', 'success');
  el.classList.add(type === 'success' ? 'success' : 'error');
}

function logout() {
  const state = getState();
  state.currentUserId = null;
  saveState(state);
  window.location.href = './index.html';
}

function bindGlobalHeader() {
  const user = getCurrentUser();
  const loginLink = document.getElementById('nav-login');
  const registerLink = document.getElementById('nav-register');
  const logoutLink = document.getElementById('nav-logout');
  const cta = document.getElementById('cta-link');

  if (user) {
    if (loginLink) loginLink.classList.add('hidden');
    if (registerLink) registerLink.classList.add('hidden');
    if (logoutLink) logoutLink.classList.remove('hidden');
    if (cta) {
      cta.textContent = 'Go to your account';
      cta.href = './my_account.html';
    }
  } else {
    if (loginLink) loginLink.classList.remove('hidden');
    if (registerLink) registerLink.classList.remove('hidden');
    if (logoutLink) logoutLink.classList.add('hidden');
    if (cta) {
      cta.textContent = 'Create an account';
      cta.href = './register.html';
    }
  }

  if (logoutLink) {
    logoutLink.addEventListener('click', (event) => {
      event.preventDefault();
      logout();
    });
  }
}

function handleRegister() {
  const form = document.getElementById('register-form');
  if (!form) return;

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    const name = (formData.get('name') || '').toString().trim();
    const email = (formData.get('email') || '').toString().trim();
    const password = (formData.get('password') || '').toString();

    if (!name || !email || !password) {
      setFlash('register-message', 'Name, email, and password are required.', 'error');
      return;
    }

    const state = getState();
    const exists = state.users.some((user) => user.email.toLowerCase() === email.toLowerCase());
    if (exists) {
      setFlash('register-message', 'That email is already registered.', 'error');
      return;
    }

    const newUser = {
      id: Date.now(),
      name,
      email,
      password,
      role: 'customer'
    };

    state.users.push(newUser);
    saveState(state);
    setFlash('register-message', 'Account created successfully. Redirecting to login...', 'success');

    setTimeout(() => {
      window.location.href = './login.html';
    }, 600);
  });
}

function handleLogin() {
  const form = document.getElementById('login-form');
  if (!form) return;

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    const email = (formData.get('email') || '').toString().trim();
    const password = (formData.get('password') || '').toString();

    if (!email || !password) {
      setFlash('login-message', 'Email and password are required.', 'error');
      return;
    }

    const state = getState();
    const user = state.users.find(
      (entry) => entry.email.toLowerCase() === email.toLowerCase() && entry.password === password
    );

    if (!user) {
      setFlash('login-message', 'Invalid login. Please check your email and password.', 'error');
      return;
    }

    setCurrentUser(user.id);
    window.location.href = './my_account.html';
  });
}

function renderAccountPage() {
  const user = getCurrentUser();
  if (!user) {
    window.location.href = './login.html';
    return;
  }

  const emailEl = document.getElementById('user-email');
  const roleEl = document.getElementById('user-role');
  const nameEl = document.getElementById('welcome-name');
  const ordersList = document.getElementById('orders-list');
  const logoutLink = document.getElementById('logout-link');

  if (nameEl) nameEl.textContent = `Welcome, ${user.name}`;
  if (emailEl) emailEl.textContent = user.email;
  if (roleEl) roleEl.textContent = user.role;
  if (logoutLink) {
    logoutLink.addEventListener('click', (event) => {
      event.preventDefault();
      logout();
    });
  }

  const state = getState();
  const userOrders = state.orders.filter((order) => order.userId === user.id);

  if (!ordersList) return;
  ordersList.innerHTML = '';

  if (!userOrders.length) {
    const li = document.createElement('li');
    li.textContent = 'No orders yet.';
    ordersList.appendChild(li);
    return;
  }

  userOrders.forEach((order) => {
    const li = document.createElement('li');
    li.innerHTML = `
      <strong>${order.itemName}</strong>
      <span>Qty: ${order.quantity}</span>
      <span>${order.notes || 'No notes'}</span>
    `;
    ordersList.appendChild(li);
  });
}

function renderAdminPage() {
  const user = getCurrentUser();
  if (!user || user.role !== 'admin') {
    window.location.href = './login.html';
    return;
  }

  const state = getState();
  const welcome = document.getElementById('admin-welcome');
  const adminOrders = document.getElementById('admin-orders');
  const adminUsers = document.getElementById('admin-users');

  if (welcome) {
    welcome.textContent = `Logged in as ${user.name}.`;
  }

  if (adminOrders) {
    adminOrders.innerHTML = '';
    if (!state.orders.length) {
      const li = document.createElement('li');
      li.textContent = 'No orders yet.';
      adminOrders.appendChild(li);
    } else {
      state.orders.forEach((order) => {
        const userEntry = state.users.find((entry) => entry.id === order.userId);
        const li = document.createElement('li');
        li.innerHTML = `
          <strong>${order.itemName}</strong>
          <span>Qty: ${order.quantity}</span>
          <span>Customer: ${userEntry ? userEntry.name : 'Guest'}</span>
        `;
        adminOrders.appendChild(li);
      });
    }
  }

  if (adminUsers) {
    adminUsers.innerHTML = '';
    state.users.forEach((entry) => {
      const li = document.createElement('li');
      li.innerHTML = `
        <strong>${entry.name}</strong>
        <span>${entry.email}</span>
      `;
      adminUsers.appendChild(li);
    });
  }

  const logoutLink = document.getElementById('admin-logout');
  if (logoutLink) {
    logoutLink.addEventListener('click', (event) => {
      event.preventDefault();
      logout();
    });
  }
}

function handleOrderSubmit() {
  const form = document.getElementById('order-form');
  if (!form) return;

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const currentUser = getCurrentUser();

    if (!currentUser) {
      window.location.href = './login.html';
      return;
    }

    const formData = new FormData(form);
    const itemName = (formData.get('item_name') || '').toString().trim();
    const quantity = Number(formData.get('quantity')) || 1;
    const notes = (formData.get('notes') || '').toString().trim();

    const state = getState();
    state.orders.push({
      id: Date.now(),
      userId: currentUser.id,
      itemName,
      quantity,
      notes
    });

    saveState(state);
    window.location.href = './my_account.html';
  });
}

function init() {
  bindGlobalHeader();
  handleRegister();
  handleLogin();
  handleOrderSubmit();

  if (document.body.dataset.page === 'account') {
    renderAccountPage();
  }

  if (document.body.dataset.page === 'admin') {
    renderAdminPage();
  }
}

document.addEventListener('DOMContentLoaded', init);
