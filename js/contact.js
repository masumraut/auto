// js/contact.js
(() => {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const btn = document.getElementById('ct-submit');
    const status = document.getElementById('ct-status');
    const phoneOk = v => /^(?:\+?91[\s-]?|0)?[6-9]\d{9}$/.test(v.replace(/[\s-]/g, ''));

    const rules = {
        name:    v => v.trim().length >= 2 || 'Please enter your name.',
        phone:   v => phoneOk(v.trim()) || 'Enter a valid 10-digit Indian mobile number.',
        message: v => v.trim().length >= 5 || 'Please write a short message.'
    };

    function setError(field, msg) {
        const box = form.querySelector(`[data-for="${field}"]`);
        const wrap = form.elements[field].closest('.ct-field');
        box.textContent = msg || '';
        wrap.classList.toggle('invalid', Boolean(msg));
    }

    function validate() {
        let ok = true;
        for (const field in rules) {
            const res = rules[field](form.elements[field].value);
            setError(field, res === true ? '' : res);
            if (res !== true) ok = false;
        }
        if (!ok) {
            const first = form.querySelector('.invalid input, .invalid textarea');
            if (first) first.focus();
        }
        return ok;
    }

    function show(msg, type) {
        status.textContent = msg;
        status.className = 'ct-status ' + type;
    }

    // Clear an error as soon as the person starts fixing it
    form.addEventListener('input', e => { if (rules[e.target.name]) setError(e.target.name, ''); });

    form.addEventListener('submit', async e => {
        e.preventDefault();
        show('', '');
        if (!validate()) return;

        btn.disabled = true;
        btn.querySelector('.ct-btn-text').textContent = 'Sending...';

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json().catch(() => ({}));
            if (res.ok && data.ok) {
                form.reset();
                show('Thank you! We have received your message and will call you back soon.', 'ok');
            } else {
                show(data.error || 'Something went wrong. Please call us instead.', 'bad');
            }
        } catch (err) {
            show('Could not reach the server. Please check your internet or call us.', 'bad');
        } finally {
            btn.disabled = false;
            btn.querySelector('.ct-btn-text').textContent = 'Send Message';
        }
    });
})();