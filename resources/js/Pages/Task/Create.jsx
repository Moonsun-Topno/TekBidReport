import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth }) {
    const {data, setData, post, errors, reset} = useForm({
        type: '',
        case_type: '',
        region: '',
        customer: '',
        reference_number: '',

    })

    const onSubmit = (e) => {
        e.preventDefault();

        post(route('task.store'))
    }
    return (
        <Authenticated
        
        user={auth.user}
            header={
                <div className="flex justify-between" >
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">Add new Tasks</h2>
                </div>
             }>

<Head title="Tasks" />

<div className="py-12">
    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-black-900">
                <form
                    onSubmit={onSubmit}
                    >

                <div className="mt-4">
                <InputLabel htmlFor="task_type" value="Type" />

                <TextInput
                  id="task_type"
                  type="text"
                  name="type"
                  value={data.type}
                  className="mt-1 block w-full"
                  isFocused={true}
                  onChange={(e) => setData("type", e.target.value)}
                />

                <InputError message={errors.type} className="mt-2" />
              </div>

              <div className="mt-4">
                <InputLabel htmlFor="task_case_type" value="Case Type" />

                <TextInput
                  id="task_case_type"
                  type="text"
                  name="case_type"
                  value={data.case_type}
                  className="mt-1 block w-full"
                  isFocused={false}
                  onChange={(e) => setData("case_type", e.target.value)}
                />

                <InputError message={errors.case_type} className="mt-2" />
              </div>

              <div className="mt-4">
                <InputLabel htmlFor="task_region" value="Region" />

                <TextInput
                  id="task_region"
                  type="text"
                  name="region"
                  value={data.region}
                  className="mt-1 block w-full"
                  isFocused={false}
                  onChange={(e) => setData("region", e.target.value)}
                />

                <InputError message={errors.region} className="mt-2" />
              </div>

              <div className="mt-4">
                <InputLabel htmlFor="task_customer" value="Customer" />

                <TextInput
                  id="task_customer"
                  type="text"
                  name="customer"
                  value={data.customer}
                  className="mt-1 block w-full"
                  isFocused={false}
                  onChange={(e) => setData("customer", e.target.value)}
                />

                <InputError message={errors.customer} className="mt-2" />
              </div>

              <div className="mt-4">
                <InputLabel htmlFor="task_reference_number" value="Reference Number" />

                <TextInput
                  id="task_reference_number"
                  type="text"
                  name="reference_number"
                  value={data.reference_number}
                  className="mt-1 block w-full"
                  isFocused={false}
                  onChange={(e) => setData("reference_number", e.target.value)}
                />

                <InputError message={errors.reference_number} className="mt-2" />
                
                </div>

                <div className="mt-4 text-right">

                    <Link href={route("task.index")}
                                      className="bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all hover:bg-gray-200 mr-2"
>
                        Cancel
                    </Link>

                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600">
                            Submit
                        </button>
                    </div>

                </form>
                </div>
                </div>
                </div>
                </div>


        </Authenticated>
    )
}