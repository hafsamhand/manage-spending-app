import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, useParams } from 'react-router-dom';

export default function LoansForm() {
    const { id } = useParams();
    const [form, setForm] = useState({ type: 'borrowed', person: '', amount: '', status: 'pending', due_date: '', description: '' });
    const [errors, setErrors] = useState({});
    const navigate = useNavigate();

    useEffect(() => {
        if (id) {
            axios.get(`/api/loans/${id}`).then(res => setForm(res.data));
        }
    }, [id]);

    function handleChange(e) {
        setForm(f => ({ ...f, [e.target.name]: e.target.value }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        setErrors({});
        const method = id ? 'put' : 'post';
        const url = id ? `/api/loans/${id}` : '/api/loans';
        axios[method](url, form)
            .then(() => navigate('/loans'))
            .catch(err => setErrors(err.response?.data?.errors || {}));
    }

    return (
        <form onSubmit={handleSubmit} className="bg-white p-4 rounded shadow max-w-md mx-auto">
            <h2 className="font-bold mb-2">{id ? 'Edit Loan' : 'Add Loan'}</h2>
            <div className="mb-2">
                <label className="block">Type</label>
                <select name="type" value={form.type} onChange={handleChange} className="border px-2 py-1 w-full">
                    <option value="borrowed">Borrowed</option>
                    <option value="given">Given</option>
                </select>
                {errors.type && <div className="text-red-500">{errors.type[0]}</div>}
            </div>
            <div className="mb-2">
                <label className="block">Person</label>
                <input type="text" name="person" value={form.person} onChange={handleChange} className="border px-2 py-1 w-full" />
                {errors.person && <div className="text-red-500">{errors.person[0]}</div>}
            </div>
            <div className="mb-2">
                <label className="block">Amount</label>
                <input type="number" name="amount" value={form.amount} onChange={handleChange} className="border px-2 py-1 w-full" />
                {errors.amount && <div className="text-red-500">{errors.amount[0]}</div>}
            </div>
            <div className="mb-2">
                <label className="block">Status</label>
                <select name="status" value={form.status} onChange={handleChange} className="border px-2 py-1 w-full">
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
                {errors.status && <div className="text-red-500">{errors.status[0]}</div>}
            </div>
            <div className="mb-2">
                <label className="block">Due Date</label>
                <input type="date" name="due_date" value={form.due_date} onChange={handleChange} className="border px-2 py-1 w-full" />
                {errors.due_date && <div className="text-red-500">{errors.due_date[0]}</div>}
            </div>
            <div className="mb-2">
                <label className="block">Description</label>
                <textarea name="description" value={form.description} onChange={handleChange} className="border px-2 py-1 w-full" />
                {errors.description && <div className="text-red-500">{errors.description[0]}</div>}
            </div>
            <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">{id ? 'Update' : 'Create'}</button>
        </form>
    );
}
