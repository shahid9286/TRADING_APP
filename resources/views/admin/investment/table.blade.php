                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Start/Expiry Date & Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investments as $investment)
                                <tr>
                                    <td>{{ $investment->id }}</td>
                                    <td>{{ $investment->amount }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}

                                        @if ($investment->is_active === 'active')
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Expired') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('No investment found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
