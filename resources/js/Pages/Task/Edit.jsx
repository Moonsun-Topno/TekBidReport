import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextAreaInput from "@/Components/TextAreaInput";
import TextInput from "@/Components/TextInput";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth, task }) {
    const {data, setData, put, errors, reset} = useForm({
        comments: '',
        _methtod: "PUT",
    })

    const onSubmit = (e) => {
        e.preventDefault();

        put(route('task.update', task.id))
    }
    return (
        <Authenticated
        
        user={auth.user}
            header={
                <div className="flex justify-between" >
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">Submit</h2>
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
                <InputLabel htmlFor="task_comments" value="Comments" />

                <TextAreaInput  
                  id="task_comments"
                  type="comments"
                  name="comments"
                  value={data.comments}
                  className="mt-1 block w-full"
                  isFocused={true}
                  onChange={(e) => setData("comments", e.target.value)}
                />

                <InputError message={errors.type} className="mt-2" />
              </div>

                              <div className="mt-4 text-right">

                    <Link href={route("task.today")}
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