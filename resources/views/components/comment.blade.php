@props(['addNew' => false, 'comment' => null])

<div class="textarea-container my-2">
    <textarea id="myTextarea" class="form-control" placeholder="Write a comment" rows="3" cols="10"
        {{ $addNew ? null : 'disabled' }}>{{ $comment?->body }}</textarea>

    <!-- Dropdown for more options -->
    @if (!$addNew)
        <div class="dropdown more-options">
            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Report</a></li>
                @if (Auth::user()->type == 'candidate' && $comment?->candidate_id == Auth::user()->candidate->id)
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                @endif

            </ul>
        </div>
    @else
        @if (Auth::user()->type == 'candidate')
            <div class="d-flex justify-content-start mt-3">
                <button class="btn btn-primary">Save</button>
            </div>
        @endif
    @endif
</div>
<style>
    .textarea-container {
        position: relative;
        display: inline-block;
    }

    #myTextarea {
        width: 100%;
        padding-right: 40px;
        /* Add space for the three dots */
        box-sizing: border-box;
    }

    .more-options {
        position: absolute;
        top: 0px;
        right: 30px;
    }
</style>
