@props([
    'name' => 'gambar',
    'label' => 'Gambar',
    'current' => null,
    'required' => false,
])

@php
    $uid = 'upload-'.uniqid();
    $preview = $current ? asset($current) : '';
@endphp

<div>
    <label for="{{ $uid }}-file" class="block text-sm font-medium text-slate-700">{{ $label }}</label>

    <div id="{{ $uid }}-dropzone"
         role="button"
         tabindex="0"
         class="mt-2 flex cursor-pointer flex-col items-center justify-center gap-2 rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center outline-none transition hover:border-indigo-400 hover:bg-indigo-50 focus:border-indigo-400 focus:bg-indigo-50">
        <img id="{{ $uid }}-preview" @if ($preview) src="{{ $preview }}" @endif
             alt="Pratinjau gambar" class="max-h-40 w-auto rounded-lg object-contain {{ $preview ? '' : 'hidden' }}">
        <i id="{{ $uid }}-icon" class="fa-solid fa-cloud-arrow-up text-3xl text-slate-400 {{ $preview ? 'hidden' : '' }}"></i>
        <p class="text-sm text-slate-500">
            Tarik &amp; letakkan gambar di sini atau
            <span class="font-medium text-indigo-600">pilih file</span>
        </p>
        <p id="{{ $uid }}-filename" class="hidden text-xs font-medium text-indigo-600"></p>
        <p class="text-xs text-slate-400">PNG, JPG, JPEG, atau WEBP. Maksimal 2 MB.</p>
    </div>

    <input type="file" id="{{ $uid }}-file" name="{{ $name }}" accept="image/*" class="hidden" @required($required)>

    @error($name) <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<script>
    (function () {
        var dropzone = document.getElementById('{{ $uid }}-dropzone');
        var input = document.getElementById('{{ $uid }}-file');
        var preview = document.getElementById('{{ $uid }}-preview');
        var icon = document.getElementById('{{ $uid }}-icon');
        var nameEl = document.getElementById('{{ $uid }}-filename');

        if (! dropzone || ! input) return;

        function show(file) {
            if (! file || ! file.type || file.type.indexOf('image/') !== 0) return;

            if (nameEl) {
                nameEl.textContent = file.name;
                nameEl.classList.remove('hidden');
            }

            var reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.classList.remove('hidden');
                if (icon) icon.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        dropzone.addEventListener('click', function () { input.click(); });

        dropzone.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                input.click();
            }
        });

        input.addEventListener('change', function () { show(input.files[0]); });

        ['dragenter', 'dragover'].forEach(function (type) {
            dropzone.addEventListener(type, function (event) {
                event.preventDefault();
                dropzone.classList.add('border-indigo-500', 'bg-indigo-50');
            });
        });

        ['dragleave', 'dragend'].forEach(function (type) {
            dropzone.addEventListener(type, function (event) {
                event.preventDefault();
                dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
            });
        });

        dropzone.addEventListener('drop', function (event) {
            event.preventDefault();
            dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');

            var files = event.dataTransfer.files;

            if (files && files.length) {
                input.files = files;
                show(files[0]);
            }
        });
    })();
</script>
