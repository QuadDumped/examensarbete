import torch
from transformers import GPT2LMHeadModel, GPT2TokenizerFast
import sys 

tokenizer = GPT2TokenizerFast.from_pretrained('gpt2')
model = GPT2LMHeadModel.from_pretrained('gpt2')

arg1 = sys.argv[1]
inputs = tokenizer.encode(arg1, return_tensors='pt')
outputs = model.generate(inputs, max_length=1000, do_sample=True)
text = tokenizer.decode(outputs[0], skip_special_tokens=True)

print(text)








