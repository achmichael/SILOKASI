<!-- Reusable Add Item Modal Component -->
<style>
    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Modal Container */
    .modal-container {
        background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
        border-radius: 20px;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        position: relative;
        transform: scale(0.95) translateY(30px);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modal-overlay.active .modal-container {
        transform: scale(1) translateY(0);
    }

    /* Modal Header */
    .modal-header {
        padding: 1.8rem 2rem;
        background: linear-gradient(135deg, #0f3460 0%, #16213e 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .modal-icon {
        font-size: 1.8rem;
        filter: drop-shadow(0 0 8px rgba(96, 165, 250, 0.5));
    }

    .modal-close {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.5);
        transform: rotate(90deg);
    }

    /* Modal Body - Step Layout */
    .modal-body {
        padding: 2rem;
        max-height: calc(90vh - 180px);
        overflow-y: auto;
    }

    /* Step Indicator */
    .step-indicator {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .step-indicator::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 40px;
        right: 40px;
        height: 2px;
        background: rgba(255, 255, 255, 0.1);
        z-index: 0;
    }

    .step {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .step.active .step-number {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        border-color: #60a5fa;
        color: #ffffff;
        box-shadow: 0 0 20px rgba(96, 165, 250, 0.5);
    }

    .step.completed .step-number {
        background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        border-color: #34d399;
        color: #ffffff;
    }

    .step-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.5);
        font-weight: 500;
        text-align: center;
        transition: all 0.3s ease;
    }

    .step.active .step-label {
        color: #60a5fa;
        font-weight: 600;
    }

    /* Form Steps Container */
    .form-steps {
        position: relative;
    }

    .form-step {
        display: none;
        animation: fadeInStep 0.4s ease;
    }

    .form-step.active {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    @keyframes fadeInStep {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        color: #60a5fa;
        font-weight: 600;
        margin-bottom: 0.6rem;
        font-size: 0.9rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.2rem;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.9rem 1.2rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #fff;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
        grid-column: 1 / -1;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #60a5fa;
        background: rgba(96, 165, 250, 0.05);
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
    }

    .form-input:hover,
    .form-textarea:hover {
        border-color: rgba(255, 255, 255, 0.2);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-hint {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 0.4rem;
        display: block;
    }

    /* Character Counter */
    .char-counter {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.4);
        text-align: right;
        margin-top: 0.3rem;
    }

    .char-counter.warning {
        color: #fbbf24;
    }

    .char-counter.danger {
        color: #ef4444;
    }

    /* Alert Messages */
    .modal-alert {
        padding: 1rem 1.2rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        display: none;
        animation: slideDown 0.3s ease;
    }

    .modal-alert.show {
        display: block;
    }

    .modal-alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
    }

    .modal-alert-success {
        background: rgba(52, 211, 153, 0.1);
        border: 1px solid rgba(52, 211, 153, 0.3);
        color: #6ee7b7;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Modal Footer */
    .modal-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(15, 15, 15, 0.3);
        display: flex;
        gap: 1rem;
        justify-content: space-between;
    }

    .btn {
        padding: 0.85rem 1.8rem;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.5s, height 0.5s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-prev,
    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
    }

    .btn-prev:hover,
    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .btn-next,
    .btn-submit {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
    }

    .btn-next:hover,
    .btn-submit:hover {
        box-shadow: 0 6px 25px rgba(96, 165, 250, 0.5);
        transform: translateY(-2px);
    }

    .btn-submit:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Loading Spinner */
    .spinner {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        margin-right: 0.5rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modal-container {
            width: 95%;
            max-width: none;
        }

        .step-indicator {
            margin-bottom: 2rem;
        }

        .step-number {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }

        .step-label {
            font-size: 0.75rem;
        }

        .form-step.active {
            grid-template-columns: 1fr;
        }

        .modal-title {
            font-size: 1.3rem;
        }

        .modal-footer {
            flex-direction: row;
        }

        .btn {
            flex: 1;
        }
    }

    /* Scrollbar */
    .modal-body::-webkit-scrollbar {
        width: 6px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: rgba(96, 165, 250, 0.3);
        border-radius: 3px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: rgba(96, 165, 250, 0.5);
    }
</style>

<!-- Add Criteria Modal -->
<div class="modal-overlay" id="addCriteriaModal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">
                <span class="modal-icon">📋</span>
                Tambah Kriteria Baru
            </h2>
            <button class="modal-close" onclick="closeModal('addCriteriaModal')">×</button>
        </div>

        <div class="modal-body">
            <div class="modal-alert modal-alert-error" id="criteriaAlertError"></div>
            <div class="modal-alert modal-alert-success" id="criteriaAlertSuccess"></div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Kode</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Nama</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Deskripsi</div>
                </div>
            </div>

            <!-- Form Steps -->
            <form id="addCriteriaForm">
                <div class="form-steps">
                    <!-- Step 1: Code -->
                    <div class="form-step active" data-step="1">
                        <div class="form-group">
                            <label class="form-label">Kode Kriteria<span class="required">*</span></label>
                            <input 
                                type="text" 
                                class="form-input" 
                                id="criteriaCode"
                                name="code"
                                placeholder="Contoh: KT, BB, LL"
                                maxlength="10"
                                required
                            >
                            <span class="form-hint">Maksimal 10 karakter</span>
                            <div class="char-counter" id="codeCounter">0/10</div>
                        </div>
                    </div>

                    <!-- Step 2: Name -->
                    <div class="form-step" data-step="2">
                        <div class="form-group">
                            <label class="form-label">Nama Kriteria<span class="required">*</span></label>
                            <input 
                                type="text" 
                                class="form-input" 
                                id="criteriaName"
                                name="name"
                                placeholder="Contoh: Kondisi Tanah"
                                maxlength="100"
                                required
                            >
                            <span class="form-hint">Maksimal 100 karakter</span>
                            <div class="char-counter" id="nameCounter">0/100</div>
                        </div>
                    </div>

                    <!-- Step 3: Description -->
                    <div class="form-step" data-step="3">
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea 
                                class="form-textarea" 
                                id="criteriaDescription"
                                name="description"
                                placeholder="Jelaskan kriteria ini secara detail..."
                                rows="5"
                            ></textarea>
                            <span class="form-hint">Opsional - Deskripsi lengkap tentang kriteria</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn btn-prev" id="criteriaPrevBtn" onclick="prevStep('criteria')" style="display: none;">
                ← Kembali
            </button>
            <button class="btn btn-cancel" onclick="closeModal('addCriteriaModal')">Batal</button>
            <button class="btn btn-next" id="criteriaNextBtn" onclick="nextStep('criteria')">
                Lanjut →
            </button>
            <button class="btn btn-submit" id="submitCriteriaBtn" onclick="submitCriteria()" style="display: none;">
                Simpan Kriteria
            </button>
        </div>
    </div>
</div>

<!-- Add Alternative Modal -->
<div class="modal-overlay" id="addAlternativeModal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">
                <span class="modal-icon">📍</span>
                Tambah Alternatif Baru
            </h2>
            <button class="modal-close" onclick="closeModal('addAlternativeModal')">×</button>
        </div>

        <div class="modal-body">
            <div class="modal-alert modal-alert-error" id="alternativeAlertError"></div>
            <div class="modal-alert modal-alert-success" id="alternativeAlertSuccess"></div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Kode</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Nama Lokasi</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Deskripsi</div>
                </div>
            </div>

            <!-- Form Steps -->
            <form id="addAlternativeForm">
                <div class="form-steps">
                    <!-- Step 1: Code -->
                    <div class="form-step active" data-step="1">
                        <div class="form-group">
                            <label class="form-label">Kode Alternatif<span class="required">*</span></label>
                            <input 
                                type="text" 
                                class="form-input" 
                                id="alternativeCode"
                                name="code"
                                placeholder="Contoh: A1, A2, A3"
                                maxlength="10"
                                required
                            >
                            <span class="form-hint">Maksimal 10 karakter</span>
                            <div class="char-counter" id="altCodeCounter">0/10</div>
                        </div>
                    </div>

                    <!-- Step 2: Name -->
                    <div class="form-step" data-step="2">
                        <div class="form-group">
                            <label class="form-label">Nama Lokasi<span class="required">*</span></label>
                            <input 
                                type="text" 
                                class="form-input" 
                                id="alternativeName"
                                name="name"
                                placeholder="Contoh: Bekonang, Gentan"
                                maxlength="100"
                                required
                            >
                            <span class="form-hint">Maksimal 100 karakter</span>
                            <div class="char-counter" id="altNameCounter">0/100</div>
                        </div>
                    </div>

                    <!-- Step 3: Description -->
                    <div class="form-step" data-step="3">
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea 
                                class="form-textarea" 
                                id="alternativeDescription"
                                name="description"
                                placeholder="Jelaskan lokasi alternatif ini secara detail..."
                                rows="5"
                            ></textarea>
                            <span class="form-hint">Opsional - Deskripsi lengkap tentang lokasi alternatif</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn btn-prev" id="alternativePrevBtn" onclick="prevStep('alternative')" style="display: none;">
                ← Kembali
            </button>
            <button class="btn btn-cancel" onclick="closeModal('addAlternativeModal')">Batal</button>
            <button class="btn btn-next" id="alternativeNextBtn" onclick="nextStep('alternative')">
                Lanjut →
            </button>
            <button class="btn btn-submit" id="submitAlternativeBtn" onclick="submitAlternative()" style="display: none;">
                Simpan Alternatif
            </button>
        </div>
    </div>
</div>

<script>
    const API_BASE_URL = '/api';
    let currentStep = {
        criteria: 1,
        alternative: 1
    };

    // Modal Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            // Reset to first step
            const type = modalId.includes('Criteria') ? 'criteria' : 'alternative';
            currentStep[type] = 1;
            updateStepDisplay(type);
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
            
            // Reset form
            if (modalId === 'addCriteriaModal') {
                document.getElementById('addCriteriaForm').reset();
                resetCharCounters('criteria');
                hideAlert('criteriaAlertError');
                hideAlert('criteriaAlertSuccess');
                currentStep.criteria = 1;
                updateStepDisplay('criteria');
            } else if (modalId === 'addAlternativeModal') {
                document.getElementById('addAlternativeForm').reset();
                resetCharCounters('alternative');
                hideAlert('alternativeAlertError');
                hideAlert('alternativeAlertSuccess');
                currentStep.alternative = 1;
                updateStepDisplay('alternative');
            }
        }
    }

    // Step Navigation
    function updateStepDisplay(type) {
        const modalId = type === 'criteria' ? 'addCriteriaModal' : 'addAlternativeModal';
        const modal = document.getElementById(modalId);
        const totalSteps = 3;
        
        // Update step indicators
        const steps = modal.querySelectorAll('.step');
        const formSteps = modal.querySelectorAll('.form-step');
        
        steps.forEach((step, index) => {
            const stepNum = index + 1;
            if (stepNum < currentStep[type]) {
                step.classList.add('completed');
                step.classList.remove('active');
            } else if (stepNum === currentStep[type]) {
                step.classList.add('active');
                step.classList.remove('completed');
            } else {
                step.classList.remove('active', 'completed');
            }
        });
        
        // Update form steps
        formSteps.forEach((formStep, index) => {
            if (index + 1 === currentStep[type]) {
                formStep.classList.add('active');
            } else {
                formStep.classList.remove('active');
            }
        });
        
        // Update buttons
        const prevBtn = document.getElementById(type + 'PrevBtn');
        const nextBtn = document.getElementById(type + 'NextBtn');
        const submitBtn = document.getElementById('submit' + (type === 'criteria' ? 'Criteria' : 'Alternative') + 'Btn');
        
        if (currentStep[type] === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
        }
        
        if (currentStep[type] === totalSteps) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
        } else {
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
        }
    }

    function nextStep(type) {
        const totalSteps = 3;
        
        // Validate current step
        if (!validateStep(type, currentStep[type])) {
            return;
        }
        
        if (currentStep[type] < totalSteps) {
            currentStep[type]++;
            updateStepDisplay(type);
        }
    }

    function prevStep(type) {
        if (currentStep[type] > 1) {
            currentStep[type]--;
            updateStepDisplay(type);
        }
    }

    function validateStep(type, step) {
        if (type === 'criteria') {
            if (step === 1) {
                const code = document.getElementById('criteriaCode').value.trim();
                if (!code) {
                    showAlert('criteriaAlertError', 'Kode kriteria wajib diisi!');
                    return false;
                }
            } else if (step === 2) {
                const name = document.getElementById('criteriaName').value.trim();
                if (!name) {
                    showAlert('criteriaAlertError', 'Nama kriteria wajib diisi!');
                    return false;
                }
            }
            hideAlert('criteriaAlertError');
        } else if (type === 'alternative') {
            if (step === 1) {
                const code = document.getElementById('alternativeCode').value.trim();
                if (!code) {
                    showAlert('alternativeAlertError', 'Kode alternatif wajib diisi!');
                    return false;
                }
            } else if (step === 2) {
                const name = document.getElementById('alternativeName').value.trim();
                if (!name) {
                    showAlert('alternativeAlertError', 'Nama alternatif wajib diisi!');
                    return false;
                }
            }
            hideAlert('alternativeAlertError');
        }
        return true;
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Alert Functions
    function showAlert(elementId, message) {
        const alert = document.getElementById(elementId);
        alert.textContent = message;
        alert.classList.add('show');
    }

    function hideAlert(elementId) {
        const alert = document.getElementById(elementId);
        alert.classList.remove('show');
    }

    // Character Counter
    function setupCharCounter(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        
        if (input && counter) {
            input.addEventListener('input', function() {
                const length = this.value.length;
                counter.textContent = `${length}/${maxLength}`;
                
                if (length > maxLength * 0.9) {
                    counter.classList.add('danger');
                    counter.classList.remove('warning');
                } else if (length > maxLength * 0.7) {
                    counter.classList.add('warning');
                    counter.classList.remove('danger');
                } else {
                    counter.classList.remove('warning', 'danger');
                }
            });
        }
    }

    function resetCharCounters(type) {
        if (type === 'criteria') {
            document.getElementById('codeCounter').textContent = '0/10';
            document.getElementById('nameCounter').textContent = '0/100';
        } else if (type === 'alternative') {
            document.getElementById('altCodeCounter').textContent = '0/10';
            document.getElementById('altNameCounter').textContent = '0/100';
        }
    }

    // Initialize character counters
    setupCharCounter('criteriaCode', 'codeCounter', 10);
    setupCharCounter('criteriaName', 'nameCounter', 100);
    setupCharCounter('alternativeCode', 'altCodeCounter', 10);
    setupCharCounter('alternativeName', 'altNameCounter', 100);

    // Submit Criteria
    async function submitCriteria() {
        const code = document.getElementById('criteriaCode').value.trim();
        const name = document.getElementById('criteriaName').value.trim();
        const description = document.getElementById('criteriaDescription').value.trim();
        const submitBtn = document.getElementById('submitCriteriaBtn');

        // Validation
        if (!code || !name) {
            showAlert('criteriaAlertError', 'Kode dan Nama kriteria wajib diisi!');
            return;
        }

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span>Menyimpan...';

        try {
            const token = localStorage.getItem('auth_token');
            const response = await fetch(`${API_BASE_URL}/criteria`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': token ? `Bearer ${token}` : ''
                },
                body: JSON.stringify({
                    code: code,
                    name: name,
                    description: description || null
                })
            });

            const data = await response.json();

            if (response.ok) {
                showAlert('criteriaAlertSuccess', 'Kriteria berhasil ditambahkan!');
                
                // Reset form after 2 seconds and close modal
                setTimeout(() => {
                    closeModal('addCriteriaModal');
                    // Reload page or update UI
                    window.location.reload();
                }, 2000);
            } else {
                const errorMessage = data.message || 'Gagal menambahkan kriteria.';
                showAlert('criteriaAlertError', errorMessage);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Simpan Kriteria';
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('criteriaAlertError', 'Terjadi kesalahan. Silakan coba lagi.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Simpan Kriteria';
        }
    }

    // Submit Alternative
    async function submitAlternative() {
        const code = document.getElementById('alternativeCode').value.trim();
        const name = document.getElementById('alternativeName').value.trim();
        const description = document.getElementById('alternativeDescription').value.trim();
        const submitBtn = document.getElementById('submitAlternativeBtn');

        // Validation
        if (!code || !name) {
            showAlert('alternativeAlertError', 'Kode dan Nama alternatif wajib diisi!');
            return;
        }

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span>Menyimpan...';

        try {
            const token = localStorage.getItem('auth_token');
            const response = await fetch(`${API_BASE_URL}/alternatives`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': token ? `Bearer ${token}` : ''
                },
                body: JSON.stringify({
                    code: code,
                    name: name,
                    description: description || null
                })
            });

            const data = await response.json();

            if (response.ok) {
                showAlert('alternativeAlertSuccess', 'Alternatif berhasil ditambahkan!');
                
                // Reset form after 2 seconds and close modal
                setTimeout(() => {
                    closeModal('addAlternativeModal');
                    // Reload page or update UI
                    window.location.reload();
                }, 2000);
            } else {
                const errorMessage = data.message || 'Gagal menambahkan alternatif.';
                showAlert('alternativeAlertError', errorMessage);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Simpan Alternatif';
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('alternativeAlertError', 'Terjadi kesalahan. Silakan coba lagi.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Simpan Alternatif';
        }
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // ESC to close modal
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                closeModal(modal.id);
            });
        }
        
        // Enter to go to next step or submit
        if (e.key === 'Enter' && !e.shiftKey) {
            const activeModal = document.querySelector('.modal-overlay.active');
            if (activeModal) {
                e.preventDefault();
                const type = activeModal.id.includes('Criteria') ? 'criteria' : 'alternative';
                
                if (currentStep[type] < 3) {
                    nextStep(type);
                } else {
                    if (type === 'criteria') {
                        submitCriteria();
                    } else {
                        submitAlternative();
                    }
                }
            }
        }
    });
</script>

