import React from 'react';
import { Header } from './Header';
import { Navbar } from './Navbar';


const MainLayout = ({ children , user }) => {
  return (
    <div className="app-container">
        
      <Header username={user}/>
        <div className="content-wrapper" style={{ display: 'flex' }}>
      
        <main className="max-w-7xl mx-auto px-6 py-6">
          {children}
        </main>
      </div>
    </div>
  );
};

export default MainLayout;
