import Pagination from '@/Components/Pagination';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import { useState } from 'react';

export default function Index({auth, tasks}) {


    return (
        <Authenticated
            user={auth.user}
            header={
                <div className="flex justify-between" >
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">Live Report</h2>
                <Link 
                    href={route("task.create")}
                    className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                    >
                Add New
            </Link>
                </div>
             }
        >
            
            <Head title="Tasks" />

            <div className="py-12">
                <div className="max-w-8xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">

                            <div>
                            
                            </div>
                            <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead  className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                    <tr className="text-nowrap">
                                        <th className="px-3 py-3">Date</th>
                                        <th className="px-3 py-3">Bid Owner</th>
                                        <th className="px-3 py-3">Type</th>
                                        <th className="px-3 py-3">Case Type</th>
                                        <th className="px-3 py-3">Region</th>
                                        <th className="px-3 py-3">Customer</th>
                                        <th className="px-3 py-3">Ref. No.</th>
                                        <th className="px-3 py-3">Quote Recieved</th>
                                        <th className="px-3 py-3">Quote Submitted</th>
                                        <th className="px-3 py-3">Time Occupied</th>
                                        <th className="px-3 py-3">Comments</th>
                                        <th className="px-3 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {tasks.data.map((task) =>
                                    <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                        <td className="px-3 py-2">{task.date}</td>
                                        <td className="px-3 py-2">{task.owner_id.name}</td>
                                        <td className="px-3 py-2">{task.type}</td>
                                        <td className="px-3 py-2">{task.case_type}</td>
                                        <td className="px-3 py-2">{task.region}</td>
                                        <td className="px-3 py-2">{task.customer}</td>
                                        <td className="px-3 py-2">{task.reference_number}</td>
                                        <td className="px-3 py-2">{task.task_started}</td>
                                        <td className="px-3 py-2">{task.task_completed}</td>
                                        <td className="px-3 py-2">{task.time_occupied}</td>
                                        <td className="px-3 py-2">{task.comments ? (task.comments) : ("") }</td>
                                        <td className="px-3 py-2 ">
                                            {task.task_completed ? ("submitted") : (
                                                <div>
                                                <Link
                                                href={route("task.edit", task.id)}
                                                className="font-medium py-1 px-3 rounded shadow bg-blue-500 text-white dark:text-blue-500 hover:underline mx-1"
                                              >
                                                Submit
                                              </Link>
                                            </div>
                                                
                                            )}
                                        </td>
                                    </tr> 
                                
                                )}

                                </tbody>
                            </table>
                            
                        
                        </div>
                        
                    </div>
                </div>
            </div>


            </Authenticated>

    )
}