import React from 'react';

export default function Layout({ user, children }) {
    return (
        <div>
            <header className="bg-white shadow px-4 py-2 flex justify-between items-center">
                <div>
                    <a href="/dashboard" className="font-bold text-lg mr-4">Dashboard</a>
                    <a href="/expenses" className="mr-4">Expenses</a>
                    <a href="/loans" className="mr-4">Loans</a>
                </div>
                <div>
                    {user ? (
                        <>
                            <span className="mr-2">{user.name}</span>
                            <form method="POST" action="/logout" className="inline">
                                <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />
                                <button type="submit" className="text-red-500">Logout</button>
                            </form>
                        </>
                    ) : (
                        <>
                            <a href="/login" className="mr-2">Login</a>
                            <a href="/register">Register</a>
                        </>
                    )}
                </div>
            </header>
            <main className="container mx-auto py-6">{children}</main>
        </div>
    );
}
