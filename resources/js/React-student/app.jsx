// import React from 'react';
// import { createRoot } from 'react-dom/client';

// function Dashboard({ user }) {
//   return (
//     <div style={{ padding: '20px' }}>
    
//       <h1>Welcome, {user.name}!</h1>
//       <p>Email: {user.email}</p>
//       <p>Role: {user.role}</p>
//     </div>
//   );
// }

// const el = document.getElementById('app');
// const userData = JSON.parse(el.dataset.user);

// createRoot(el).render(<Dashboard user={userData} />);
// import React from 'react';
// import { createRoot } from 'react-dom/client';
// import MainLayout from './layouts/Mainlayout';
// import Dashboard from './pages/Dashboard';
// import './index.css'
// const el = document.getElementById('app');
// const userData = JSON.parse(el.dataset.user);

// function App() {
//   return (
//     <MainLayout user={userData}>
//       <Dashboard user={userData} />
//     </MainLayout>
//   );
// }

// createRoot(el).render(<App />);

import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import MainLayout from './layouts/Mainlayout';
import Dashboard from './pages/Dashboard';
import Courses from './pages/Courses';
import Boards from './pages/Boards';
import Subjects from './pages/Subjects';
import Books from './pages/Books';
import PastPapers from './pages/PastPapers';
import './app.css';

const el = document.getElementById('app');
const userData = JSON.parse(el.dataset.user);

function App() {
  return (
    <BrowserRouter>
      <MainLayout user={userData}>
        <Routes>
          <Route path="/dashboard" element={<Dashboard user={userData} />} />
          <Route path="/courses" element={<Courses user={userData}/>} />
          <Route path="/boards" element={<Boards user={userData}/>} />
          <Route path="/subjects" element={<Subjects user={userData}/>} />
          <Route path="/books" element={<Books user={userData}/>} />
          <Route path="/past-papers" element={<PastPapers user={userData}/>} />
        </Routes>
      </MainLayout>
    </BrowserRouter>
  );
}

createRoot(el).render(<App />);
