import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, useParams } from 'react-router-dom';

export default function ExpensesForm() {
    const { id } = useParams();
    const [form, setForm] = useState({ title: '', amount: '', category: '', spent_at: '', description: '' });
    const [errors, setErrors] = useState({});
    const navigate = useNavigate();

    useEffect(() => {
        if (id) {
            axios.get(`/api/expenses/${id}`).then(res => setForm(res.data));
        }
    }, [id]);

    function handleChange(e) {
        setForm(f => ({ ...f, [e.target.name]: e.target.value }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        setErrors({});
        const method = id ? 'put' : 'post';
        const url = id ? `/api/expenses/${id}` : '/api/expenses';
        axios[method](url, form)
            .then(() => navigate('/expenses'))
            .catch(err => setErrors(err.response?.data?.errors || {}));
    }

    return (
        <form onSubmit={handleSubmit} className="bg-white p-4 rounded shadow max-w-md mx-auto">
            <h2 className="font-bold mb-2">{id ? 'Edit Expense' : 'Add Expense'}</h2>
            {['title', 'amount', 'category', 'spent_at'].map(field => (
                <div key={field} className="mb-2">
                    <label className="block">{field.charAt(0).toUpperCase() + field.slice(1)}</label>
                    <input
                        type={field === 'amount' ? 'number' : field === 'spent_at' ? 'date' : 'text'}
                        name={field}
                        value={form[field]}
                        onChange={handleChange}
                        className="border px-2 py-1 w-full"
                    />
                    {errors[field] && <div className="text-red-500">{errors[field][0]}</div>}
                </div>
            ))}
            <div className="mb-2">
                <label className="block">Description</label>
                <textarea name="description" value={form.description} onChange={handleChange} className="border px-2 py-1 w-full" />
                {errors.description && <div className="text-red-500">{errors.description[0]}</div>}
            </div>
            <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">{id ? 'Update' : 'Create'}</button>
        </form>
    );
}
