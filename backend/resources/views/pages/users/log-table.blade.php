<table class="datatable-table" style="display: table">
    <thead class="datatable-head" style="display: table-header-group">
        <tr class="datatable-row" style="display: table-row">
            <th class="datatable-cell datatable-cell-sort">
                <span>Date d'achèvement</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Nom du défi</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Catégorie défi</span>
            </th>
        </tr>
    </thead>
    <tbody class="datatable-body" style="display: table-row-group">
        @foreach ($logs as $log)

        <tr class="datatable-row" style="display: table-row">
            <td data-field="Id" class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $log->completed_at }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $log->challenge->title }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $log->challenge->category->name }}</span>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

{{ $logs->links('vendor.pagination.default') }}