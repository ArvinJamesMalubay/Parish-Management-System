/**
 * Generate API Module Script
 * Automates the creation of a standardized API module structure.
 * Usage: node generate_api.js <module-name>
 */

const fs = require("fs");
const path = require("path");

const moduleName = process.argv[2];

if (!moduleName) {
  console.error(
    "Please specify a module name. Example: node generate_api.js users",
  );
  process.exit(1);
}

const baseDir = path.join(process.cwd(), "src", "api", moduleName);

if (!fs.existsSync(baseDir)) {
  fs.mkdirSync(baseDir, { recursive: true });
}

// 1. types.ts
const typesContent = `export interface ${capitalize(moduleName)} {
  id: string;
  createdAt: string;
  updatedAt: string;
}

export interface Create${capitalize(moduleName)}Dto {
  // Define fields
}
`;

// 2. schema.ts
const schemaContent = `import { z } from 'zod';

export const ${capitalize(moduleName)}Schema = z.object({
  id: z.string(),
  createdAt: z.string(),
  updatedAt: z.string(),
});
`;

// 3. client.ts
const clientContent =
  `import { api } from '../client';
import { ${capitalize(moduleName)}Schema } from './schema';
import { ${capitalize(moduleName)}, Create${capitalize(moduleName)}Dto } from './types';

export const ${moduleName}Api = {
  list: () => api.get<${capitalize(moduleName)}[]>('/${moduleName}'),
  
  get: (id: string) => api.get<${capitalize(moduleName)}>(/\/${moduleName}\/\${id}` +
  `),
  
  create: (data: Create${capitalize(moduleName)}Dto) => 
    api.post<${capitalize(moduleName)}>('/${moduleName}', data),
};
`;

fs.writeFileSync(path.join(baseDir, "types.ts"), typesContent);
fs.writeFileSync(path.join(baseDir, "schema.ts"), schemaContent);
fs.writeFileSync(path.join(baseDir, "client.ts"), clientContent);

console.log(`Successfully generated api module: ${moduleName}`);
console.log(`Path: ${baseDir}`);

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
