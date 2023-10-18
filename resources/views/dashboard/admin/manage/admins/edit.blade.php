<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">Edit Admin</div>
            <x-splade-form :default="$admin" :action="Route('admin.manage.admins.update',['id'=>$id])" method="POST" autocomplete="off">
                <div class="row-group">
                    <x-splade-input class="input" type="text" label="Username" name="name" value="{{ old('Name') }}"/>
                    <x-splade-input class="input" type="email" label="Email" name="email" value="{{ old('email') }}"/>
                </div>
                <div class="row-group">
                    <x-splade-input class="input" type="text" label="First Name" name="first_name" value="{{ old('first_name') }}"/>
                    <x-splade-input class="input" type="text" label="Last Name" name="last_name" value="{{ old('last_name') }}"/>
                </div>
                <div class="row-group">
                    <x-splade-select :options="['male' => 'Male', 'female'=>'Female']" class="input" choices label="Gender" name="gender" />
                    <x-splade-input class="input" type="email" label="Date of Brith" date name="date_of_brith" value="{{ old('email') }}"/>
                    <x-splade-input class="input" type="text" label="phone" name="phone" value="{{ old('phone') }}"/>
                </div>
                <div class="row-group">
                    <x-splade-input type="password" class="input" name="password" label="New Passowrd" />
                    <x-splade-input type="password" class="input" name="password_confirmation" label="Confirm Password" />
                </div>
                <x-splade-submit class="mt-4" style="width:100%;" label="Update" confirm/>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
