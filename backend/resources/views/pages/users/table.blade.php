<table class="datatable-table" style="display: table">
    <thead class="datatable-head" style="display: table-header-group">
        <tr class="datatable-row" style="display: table-row">
            <th class="datatable-cell datatable-cell-sort">
                <span>ID</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Image</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Prénom</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Nom de famille</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Rôle</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Email</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Code postal</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Assurance</span>
            </th>
            <th class="datatable-cell datatable-cell-sort">
                <span>Actions</span>
            </th>
        </tr>
    </thead>
    <tbody class="datatable-body" style="display: table-row-group">
        @foreach ($users as $user)

        <tr class="datatable-row" style="display: table-row">
            <td data-field="Id" class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->id }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($user->image) }}" style="width: 40px" alt="">
                    </div>
                </span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->first_name }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->last_name }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->role->code }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->email }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->zipcode }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>{{ $user->garanty }}</span>
            </td>
            <td class="datatable-cell-sorted datatable-cell-left datatable-cell">
                <span>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Bag-chair.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>
                        </a>

                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>
                        </a>

                        @if(request()->has('deleted'))

                            <form action="{{ route('users.restore', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Restore">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
												<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
											</g>
										</svg>
                                    </span>
                                </button>
                            </form>

                        @else

                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                            </form>

                        @endif
                        
                    </div>
                </span>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

{{ $users->links('vendor.pagination.default') }}