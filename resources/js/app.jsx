import React from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './components/Layout';
import Dashboard from './pages/Dashboard';
import ExpensesIndex from './pages/expenses/Index';
import ExpensesForm from './pages/expenses/Form';
import LoansIndex from './pages/loans/Index';
import LoansForm from './pages/loans/Form';

// CSRF setup
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
axios.defaults.withCredentials = true;

// props are injected by Blade into the #app dataset; read them at runtime
const props = (() => {
    try {
        const el = document.getElementById('app');
        return el ? JSON.parse(el.dataset.props || '{}') : {};
    } catch (e) {
        return {};
    }
})();

function App() {
    return (
    <BrowserRouter>
            <Layout user={props.user}>
                <Routes>
                    <Route path="/" element={<Dashboard />} />
                    <Route path="/expenses" element={<ExpensesIndex />} />
                    <Route path="/expenses/new" element={<ExpensesForm />} />
                    <Route path="/expenses/:id/edit" element={<ExpensesForm />} />
                    <Route path="/loans" element={<LoansIndex />} />
                    <Route path="/loans/new" element={<LoansForm />} />
                    <Route path="/loans/:id/edit" element={<LoansForm />} />
                    <Route path="*" element={<Navigate to="/" replace />} />
                </Routes>
            </Layout>
        </BrowserRouter>
    );
}

if (document.getElementById('app')) {
    window.props = JSON.parse(document.getElementById('app').dataset.props || '{}');
    createRoot(document.getElementById('app')).render(<App />);
}
