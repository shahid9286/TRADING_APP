@extends('admin.layouts.master')
@section('title', 'Restore Enquiry')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Restore Enquiry') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Restore Enquiry') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-dark data_table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone No') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Followup Type') }}</th>
                                            <th>{{ __('Action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($enquiries as $id => $enquiry)
                                            <tr>
                                                <td>
                                                    {{ ++$id }}
                                                </td>
                                                <td>
                                                    {{ $enquiry->name }}
                                                </td>
                                                <td>
                                                    {{ $enquiry->email }}
                                                </td>

                                                <td>
                                                    {{ $enquiry->phone_no }}
                                                </td>

                                                <td>
                                                    @if ($enquiry->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($enquiry->status == 'follow-up')
                                                        <span class="badge bg-info">Follow Up</span>
                                                    @elseif($enquiry->status == 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($enquiry->followup_type == 'call')
                                                        <span class="badge bg-primary">Call</span>
                                                    @elseif($enquiry->followup_type == 'whatsapp')
                                                        <span class="badge bg-success">WhatsApp</span>
                                                    @elseif($enquiry->followup_type == 'message')
                                                        <span class="badge bg-secondary">Message</span>
                                                    @elseif($enquiry->followup_type == 'email')
                                                        <span class="badge bg-info text-dark">Email</span>
                                                    @elseif($enquiry->followup_type == 'info-required')
                                                        <span class="badge bg-warning text-dark">Info Required</span>
                                                    @elseif($enquiry->followup_type == 'docs-required')
                                                        <span class="badge bg-danger">Docs Required</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.enquiry.restore', $enquiry->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-undo"></i>
                                                        {{ __('') }}</a>


                                                    <form id="deleteform" class="d-inline-block"
                                                        action="{{ route('admin.enquiry.force.delete', $enquiry->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                            <i class="fas fa-trash"></i>{{ __('') }}
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
