@extends('layouts.master')

@section('title', 'Chatbot PDF Assistant')

@section('content')
<div class="flex flex-col items-center min-h-screen bg-gray-50 py-10 px-2">
    <div class="bg-white rounded-2xl shadow-lg max-w-4xl w-full p-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-center mb-2">Chatbot PDF Assistant</h1>
        <p class="text-center text-gray-600 mb-8">Upload dokumen PDF untuk mendapatkan ringkasan otomatis atau mulai percakapan langsung dengan asisten AI</p>

        {{-- Upload & Ringkas PDF --}}
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-3">Upload & Ringkas PDF</h2>
            <form id="uploadForm" enctype="multipart/form-data" class="flex flex-col gap-3">
                <label for="pdfFile" id="dropLabel"
                    class="flex flex-col items-center justify-center border border-dashed border-gray-300 rounded-xl py-8 cursor-pointer hover:border-green-400 transition mb-2 relative min-h-[180px] w-full"
                    style="border-width:1.5px;">
                    <div id="plusIcon" class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-500" id="fileLabelText">Drag & drop file PDF di sini atau klik untuk memilih</span>
                    </div>
                    <div id="pdfPreview" class="flex flex-col items-center" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <rect x="4" y="4" width="16" height="16" rx="2" fill="#fff" stroke="#ef4444" stroke-width="2"/>
                            <text x="12" y="16" text-anchor="middle" fill="#ef4444" font-size="8" font-family="Arial" dy=".3em">PDF</text>
                        </svg>
                        <span id="selectedFileName" class="text-gray-700 mt-2 font-medium"></span>
                    </div>
                    <input type="file" id="pdfFile" name="pdf_file" accept=".pdf" required class="hidden" />
                </label>
                <button type="submit" class="bg-green-400 hover:bg-green-500 text-white font-semibold rounded-lg py-2 transition flex items-center justify-center gap-2 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                    Upload & Summarize
                </button>
            </form>
            <div id="uploadError" class="text-red-600 mt-2 hidden"></div>
            <div id="uploadResponse" class="text-gray-800 mt-2 hidden whitespace-pre-line"></div>
        </div>

        {{-- Chat Langsung --}}
        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-3">Chat Langsung</h2>
            <div id="chatBox" class="flex flex-col gap-2">
                <div id="responseBox" class="flex items-center justify-center text-gray-500 bg-gray-100 rounded-lg py-6 mb-2 whitespace-pre-line px-4" style="min-height:56px;display:none"></div>
                <div id="chatError" class="text-red-600 mb-2 hidden"></div>
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white">
                    <input
                        type="text"
                        id="promptInput"
                        placeholder="Ketik pesan Anda di sini..."
                        class="flex-grow outline-none bg-transparent text-gray-800"
                    />
                    <button
                        id="sendChatBtn"
                        class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded-full p-2 transition flex items-center justify-center"
                        title="Kirim"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function simpleMarkdown(text) {
    // Heading (###, ##, #)
    text = text.replace(/^### (.*$)/gim, '<b>$1</b>');
    text = text.replace(/^## (.*$)/gim, '<b>$1</b>');
    text = text.replace(/^# (.*$)/gim, '<b>$1</b>');
    // Bold: **text** atau <b>text</b>
    text = text.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
    text = text.replace(/<b>(.*?)<\/b>/g, '<b>$1</b>');
    // Italic: *text*
    text = text.replace(/\*(.*?)\*/g, '<i>$1</i>');
    // List
    text = text.replace(/^\s*-\s(.*)$/gim, '<li>$1</li>');
    // Numbered list
    text = text.replace(/^\s*\d+\.\s(.*)$/gim, '<li>$1</li>');
    // Line break
    text = text.replace(/\n/g, '<br>');
    return text;
}

// Contoh penggunaan:
// showBox('uploadResponse', simpleMarkdown(data.response || "Ringkasan tidak tersedia"), true);
</script>

<script>
function showBox(id, message, show = true) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.display = show ? 'block' : 'none';
    if (id === 'uploadResponse' || id === 'responseBox') {
        el.innerHTML = marked.parse(message || '');
    } else {
        el.textContent = message || '';
    }
}

// Upload PDF
document.getElementById('uploadForm').onsubmit = async (e) => {
    e.preventDefault();
    showBox('uploadError', '', false);
    showBox('uploadResponse', 'Sedang memproses file PDF...', true);
    const fileInput = document.getElementById('pdfFile');
    if (!fileInput.files.length) {
        showBox('uploadError', 'Pilih file PDF dulu.', true);
        showBox('uploadResponse', '', false);
        return;
    }

    const formData = new FormData();
    formData.append('pdf_file', fileInput.files[0]);

    try {
        const res = await fetch('http://127.0.0.1:5000/api/upload_pdf', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (res.ok) {
          showBox('responseBox', data.response || "Tidak ada respons dari server", true);
        } else {
            showBox('uploadError', data.error || "Gagal upload dan ringkas PDF", true);
            showBox('uploadResponse', '', false);
        }
    } catch (err) {
        showBox('uploadError', 'Error: ' + err.message, true);
        showBox('uploadResponse', '', false);
    }
};

// Chat
document.getElementById('sendChatBtn').onclick = async () => {
    const prompt = document.getElementById('promptInput').value.trim();
    showBox('chatError', '', false);
    if (!prompt) {
        showBox('chatError', "Pesan tidak boleh kosong!", true);
        return;
    }

    showBox('responseBox', 'Sedang menjawab...', true);

    try {
        const res = await fetch('http://127.0.0.1:5000/api/chat', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ prompt })
        });
        const data = await res.json();

        if (res.ok) {
            showBox('responseBox', data.response || "Tidak ada respons dari server", true);
        } else {
            showBox('chatError', data.error || "Gagal mendapatkan balasan", true);
            showBox('responseBox', '', false);
        }
    } catch (err) {
        showBox('chatError', "Error: " + err.message, true);
        showBox('responseBox', '', false);
    }
};

const fileInput = document.getElementById('pdfFile');
const selectedFileName = document.getElementById('selectedFileName');
const plusIcon = document.getElementById('plusIcon');
const pdfPreview = document.getElementById('pdfPreview');

function showPdfPreview(file) {
    if (file) {
        plusIcon.style.display = 'none';
        pdfPreview.style.display = 'flex';
        selectedFileName.textContent = file.name;
    } else {
        plusIcon.style.display = 'flex';
        pdfPreview.style.display = 'none';
        selectedFileName.textContent = '';
    }
}

fileInput.addEventListener('change', function() {
    showPdfPreview(fileInput.files[0]);
});

// Drag & drop PDF
const dropArea = document.getElementById('dropLabel');
if (dropArea && fileInput) {
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('border-green-400', 'bg-green-50');
    });
    dropArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropArea.classList.remove('border-green-400', 'bg-green-50');
    });
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('border-green-400', 'bg-green-50');
        const files = e.dataTransfer.files;
        if (files.length) {
            fileInput.files = files;
            showPdfPreview(files[0]);
        }
    });
}
</script>
@endsection

