import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function LoansIndex() {
    const [loans, setLoans] = useState([]);
    const [loading, setLoading] = useState(true);
    const [filters, setFilters] = useState({ month: '', status: '' });

    useEffect(() => {
        setLoading(true);
        axios.get('/api/loans', { params: filters }).then(res => {
            setLoans(res.data.data || []);
            setLoading(false);
        }).catch(() => setLoading(false));
    }, [filters]);

    function markAsPaid(id) {
        axios.patch(`/api/loans/${id}/mark-as-paid`).then(() => {
            setLoans(loans => loans.map(l => l.id === id ? { ...l, status: 'paid' } : l));
        });
    }

    return (
        <div>
            <div className="mb-4 flex gap-2">
                <input type="month" value={filters.month} onChange={e => setFilters(f => ({ ...f, month: e.target.value }))} className="border px-2 py-1" />
                <select value={filters.status} onChange={e => setFilters(f => ({ ...f, status: e.target.value }))} className="border px-2 py-1">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
                <Link to="/loans/new" className="bg-blue-500 text-white px-4 py-2 rounded">Add Loan</Link>
            </div>
            {loading ? <div>Loading...</div> : (
                <table className="w-full bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Person</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {loans.map(loan => (
                            <tr key={loan.id}>
                                <td>{loan.type}</td>
                                <td>{loan.person}</td>
                                <td>{loan.amount}</td>
                                <td>
                                    {loan.status}
                                    {loan.status === 'pending' && (
                                        <button onClick={() => markAsPaid(loan.id)} className="ml-2 text-green-500">Mark as Paid</button>
                                    )}
                                </td>
                                <td>{loan.due_date || '-'}</td>
                                <td>
                                    <Link to={`/loans/${loan.id}/edit`} className="text-blue-500">Edit</Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}
