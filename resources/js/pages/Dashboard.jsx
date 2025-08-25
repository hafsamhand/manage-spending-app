import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Dashboard() {
    const [stats, setStats] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/api/stats').then(res => {
            setStats(res.data);
            setLoading(false);
        }).catch(() => setLoading(false));
    }, []);

    if (loading) return <div>Loading...</div>;

    return (
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-white p-4 rounded shadow">
                <h2 className="font-bold">Total Spent This Month</h2>
                <p className="text-2xl">{Number(stats?.totalSpent || 0).toFixed(2)}</p>
            </div>
            <div className="bg-white p-4 rounded shadow">
                <h2 className="font-bold">Outstanding Borrowed</h2>
                <p className="text-2xl">{Number(stats?.totalBorrowed || 0).toFixed(2)}</p>
            </div>
            <div className="bg-white p-4 rounded shadow">
                <h2 className="font-bold">Outstanding Given</h2>
                <p className="text-2xl">{Number(stats?.totalGiven || 0).toFixed(2)}</p>
            </div>
        </div>
    );
}
