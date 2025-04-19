@include('portfolio.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Builder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }
</script>

    <div class="container mt-4">
    @auth
    <p class="text-lg font-semibold text-purple-700 bg-purple-100 px-4 py-2 rounded-md shadow-sm inline-block">
        👋 Hello, {{ Auth::user()->name }}!
    </p>
@endauth

    <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-semibold text-gray-800">My Portfolios</h2>
    <button type="button"
        class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition duration-200"
        data-bs-toggle="modal"
        data-bs-target="#createPortfolioModal">
        + Create New Portfolio
    </button>
</div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="class="flex flex-wrap gap-6 justify-start" ">
    @forelse($portfolios as $portfolio)
        <div class="w-full sm:w-10/12 md:w-1/3 lg:w-1/4 bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-2xl">
            <h5 class="text-2xl font-bold text-gray-800 mb-2 truncate">{{ $portfolio->title ?? 'Untitled' }}</h5>
            <p class="text-sm text-gray-500 mb-4"><span class="font-semibold">Template:</span> {{ $portfolio->template }}</p>

            <div class="flex flex-wrap gap-2 mb-4">
                <a href="{{ route('portfolios.show', $portfolio->id) }}"
                    class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 rounded transition no-underline">View</a>

                <button type="button"
                    class="flex-1 text-center bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 px-3 rounded transition"
                    data-bs-toggle="modal"
                    data-bs-target="#editPortfolioModal"
                    data-id="{{ $portfolio->id }}"
                    data-title="{{ $portfolio->title }}"
                    data-template="{{ $portfolio->template }}">
                    Edit
                </button>

                <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-3 rounded transition">Delete</button>
                </form>
            </div>

            <hr class="my-4 border-t border-gray-200">

            <div class="space-y-2">
                <button class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm py-2 rounded transition" data-bs-toggle="modal" data-bs-target="#addSkillModal" data-portfolio-id="{{ $portfolio->id }}">+ Add Skill</button>

                <button class="w-full bg-green-100 hover:bg-green-200 text-green-700 text-sm py-2 rounded transition" data-bs-toggle="modal" data-bs-target="#addEducationModal" data-portfolio-id="{{ $portfolio->id }}">+ Add Education</button>

                <button class="w-full bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm py-2 rounded transition" data-bs-toggle="modal" data-bs-target="#addProjectModal" data-portfolio-id="{{ $portfolio->id }}">+ Add Project</button>

                <button class="w-full bg-cyan-100 hover:bg-cyan-200 text-cyan-700 text-sm py-2 rounded transition" data-bs-toggle="modal" data-bs-target="#addExperienceModal" data-portfolio-id="{{ $portfolio->id }}">+ Add Experience</button>
                @if ($portfolio->aboutMe)
    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm py-2 rounded transition"
        data-bs-toggle="modal"
        data-bs-target="#editAboutMeModal"
        data-portfolio-id="{{ $portfolio->id }}"
        data-about-id="{{ $portfolio->aboutMe->id }}"
        data-description="{{ $portfolio->aboutMe->description }}">
        ✏️ Update About Me
    </button>
@else
    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm py-2 rounded transition"
        data-bs-toggle="modal"
        data-bs-target="#addAboutMeModal"
        data-portfolio-id="{{ $portfolio->id }}">
        + Add About Me
    </button>
@endif

            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center w-full">You haven't created any portfolios yet.</p>
    @endforelse
</div>



   <!-- Create Portfolio Modal -->
<div class="modal fade" id="createPortfolioModal" tabindex="-1" aria-labelledby="createPortfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('portfolios.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPortfolioModalLabel">Create Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Portfolio Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                    </div>
                    <div class="mb-3">
                        <label for="template" class="form-label">Select Template</label>
                        <select class="form-select" name="template" id="template">
                            <option value="" disabled selected>Select a template</option>
                            <option value="template1">Template 1</option>
                            <option value="template2">Template 2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


 <!-- Edit Portfolio Modal -->
 <div class="modal fade" id="editPortfolioModal" tabindex="-1" aria-labelledby="editPortfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editPortfolioForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPortfolioModalLabel">Edit Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Portfolio Title</label>
                        <input type="text" class="form-control" name="title" id="edit_title" placeholder="Enter title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_template" class="form-label">Select Template</label>
                        <select class="form-select" name="template" id="edit_template">
                            <option value="" disabled>Select a template</option>
                            <option value="template1">Template 1</option>
                            <option value="template2">Template 2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="addSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="skillForm">
            @csrf
            <input type="hidden" name="name" id="skill_name_input">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSkillModalLabel">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="skill_name" class="form-label">Skill Name</label>
                        <input type="text" class="form-control" id="skill_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Skill</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="educationForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEducationModalLabel">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="degree" class="form-label">Degree</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institution</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Education</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Experience Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="experienceForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExperienceModalLabel">Add Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Experience</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="project_title" class="form-label">Project Title</label>
                        <input type="text" class="form-control" name="title" id="project_title" placeholder="Enter project title" required>
                    </div>
                    <div class="mb-3">
                        <label for="project_description" class="form-label">Project Description</label>
                        <textarea class="form-control" name="description" id="project_description" rows="4" placeholder="Enter project description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Project</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add About Me Modal -->
<div class="modal fade" id="addAboutMeModal" tabindex="-1" aria-labelledby="addAboutMeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAboutMeModalLabel">Add About Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="about_description" class="form-label">Description</label>
                        <textarea class="form-control" id="about_description" name="description" rows="5" placeholder="Tell something about yourself..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="about_image" class="form-label">Upload Image (optional)</label>
                        <input type="file" class="form-control" id="about_image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="editAboutMeModal" tabindex="-1" aria-labelledby="editAboutMeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit About Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_about_description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_about_description" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_about_image" class="form-label">Update Image (optional)</label>
                        <input type="file" class="form-control" name="image" id="edit_about_image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>



    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const editModal = document.getElementById('editPortfolioModal');

editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    const title = button.getAttribute('data-title');
    const template = button.getAttribute('data-template');

    // Set the values in modal inputs
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_template').value = template;

    // ✅ Set form action properly using backticks
    const form = document.getElementById('editPortfolioForm');
    form.action = `/portfolios/${id}`;
});
</script>

<script>
    const skillModal = document.getElementById('addSkillModal');
    const skillForm = document.getElementById('skillForm');
    const skillNameInput = document.getElementById('skill_name');
    const skillNameHidden = document.getElementById('skill_name_input');

    skillModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');
        // Set form action dynamically
        skillForm.action = `/portfolios/${portfolioId}/skills`;
    });

    // Copy visible input value to hidden input on submit
    skillForm.addEventListener('submit', function () {
        skillNameHidden.value = skillNameInput.value;
    });
</script>

<script>
    const educationModal = document.getElementById('addEducationModal');
    const educationForm = document.getElementById('educationForm');

    educationModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');

        // Set the form action URL dynamically
        educationForm.action = `/portfolios/${portfolioId}/education`;
    });
</script>

<script>
    const experienceModal = document.getElementById('addExperienceModal');
    const experienceForm = document.getElementById('experienceForm');

    experienceModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');

        // Set the form action URL
        experienceForm.action = `/portfolios/${portfolioId}/experiences`;
    });
</script>

<script>
    const addProjectModal = document.getElementById('addProjectModal');
    addProjectModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');
        const form = addProjectModal.querySelector('form');

        // Set action dynamically
        form.action = `/portfolios/${portfolioId}/projects`;
    });
</script>

<script>
    const addAboutMeModal = document.getElementById('addAboutMeModal');
    addAboutMeModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');
        const form = addAboutMeModal.querySelector('form');

        // Set action dynamically
        form.action = `/portfolios/${portfolioId}/about-me`;
    });
</script>

<script>
    const editAboutMeModal = document.getElementById('editAboutMeModal');

    editAboutMeModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const portfolioId = button.getAttribute('data-portfolio-id');
        const aboutId = button.getAttribute('data-about-id');
        const description = button.getAttribute('data-description');

        const form = editAboutMeModal.querySelector('form');
        const descField = editAboutMeModal.querySelector('#edit_about_description');

        form.action = `/portfolios/${portfolioId}/about-me/${aboutId}`;
        descField.value = description;
    });
</script>



</body>
</html> 