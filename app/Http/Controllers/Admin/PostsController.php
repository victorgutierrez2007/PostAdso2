<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('category', 'user', 'tags')->latest()->paginate(10);

        $publishedCount = Post::where('is_published', true)->count();
        $draftCount     = Post::where('is_published', false)->count();

        return view('admin.posts.index', compact('posts', 'publishedCount', 'draftCount'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')],
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'image_path'   => 'nullable|string|max:500',
            'category_id'  => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags'         => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['user_id'] = auth()->id();
        $validated['excerpt'] = $validated['excerpt'] ?? '';

        if (!empty($validated['is_published']) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);
 
        if ($request->has('tags')) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post): View
    {
        $post->load('category', 'user');

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * @param Request $request
     * @param Post $post
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $postId = $post->getKey(); // <- usa getKey() en lugar de ->id para evitar el warning del IDE

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($postId)],
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'image_path'   => 'nullable|string|max:500',
            'category_id'  => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags'         => 'nullable|string',
        ]);
 
        $validated['excerpt'] = $validated['excerpt'] ?? '';

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (!empty($validated['is_published']) && empty($post->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post->update($validated);
 
        if ($request->has('tags')) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post actualizado exitosamente.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
 
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminado exitosamente.');
    }
 
    private function syncTags(Post $post, ?string $tagsString): void
    {
        if (empty($tagsString)) {
            $post->tags()->detach();
            return;
        }
 
        $tags = collect(explode(',', $tagsString))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->map(function ($tag) {
                return Tag::firstOrCreate(
                    ['slug' => Str::slug($tag)],
                    ['name' => $tag]
                )->id;
            });
 
        $post->tags()->sync($tags);
    }
}