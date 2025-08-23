import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function ExpensesIndex() {
    const [expenses, setExpenses] = useState([]);
    const [loading, setLoading] = useState(true);
    const [filters, setFilters] = useState({ month: '', category: '' });

    useEffect(() => {
        setLoading(true);
        axios.get('/api/expenses', { params: filters }).then(res => {
            setExpenses(res.data.data || []);
            setLoading(false);
        }).catch(() => setLoading(false));
    }, [filters]);

    return (
        <div>
            <div className="mb-4 flex gap-2">
                <input type="month" value={filters.month} onChange={e => setFilters(f => ({ ...f, month: e.target.value }))} className="border px-2 py-1" />
                <input type="text" placeholder="Category" value={filters.category} onChange={e => setFilters(f => ({ ...f, category: e.target.value }))} className="border px-2 py-1" />
                <Link to="/expenses/new" className="bg-blue-500 text-white px-4 py-2 rounded">Add Expense</Link>
            </div>
            {loading ? <div>Loading...</div> : (
                <table className="w-full bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {expenses.map(exp => (
                            <tr key={exp.id}>
                                <td>{exp.title}</td>
                                <td>{exp.amount}</td>
                                <td>{exp.category}</td>
                                <td>{exp.spent_at}</td>
                                <td>
                                    <Link to={`/expenses/${exp.id}/edit`} className="text-blue-500">Edit</Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}
