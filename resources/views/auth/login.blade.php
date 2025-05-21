<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">  <label for="email"><b>Adresse Email</b></label>  <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus> @error('email')
            <div class="alert alert-danger">{{ $message }}</div>  @enderror
    </div>

    <div class="form-group">
        <label for="password"><b>Mot de passe</b></label>
        <input type="password" class="form-control" name="password" id="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group form-check">  <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>  </form>
