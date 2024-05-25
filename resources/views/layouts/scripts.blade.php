<script>
    const ready = (callback) => {
        const Str = window.str;
        const Arr = window.arr;
        const Obj = window.obj;
        const test = 'hello';
        return document.addEventListener('DOMContentLoaded', ()=>{
            callback();
        });
    }
</script>
@livewireScriptConfig
<wireui:scripts />
<script src="{{ asset('assets/js/htmx.min.js') }}"></script>
@stack('scripts')
