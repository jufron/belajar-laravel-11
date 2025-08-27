<table class="min-w-full border-collapse block md:table">
    <thead class="block md:table-header-group">
        <tr class="border border-gray-300 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
            @foreach ($labels as $label)
                <th class="bg-gray-200 p-2 text-gray-600 font-bold md:border md:border-gray-300 text-left block md:table-cell">{{ $label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="block md:table-row-group">
        {{ $slot }}
    </tbody>
</table>
